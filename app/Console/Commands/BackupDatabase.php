<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;

/**
 * Ежедневное резервное копирование БД (ТЗ п.4.3).
 * Запуск: php artisan db:backup
 * Автоматически вызывается планировщиком ежедневно в 03:00 (routes/console.php).
 */
class BackupDatabase extends Command
{
    protected $signature = 'db:backup';
    protected $description = 'Создаёт резервную копию БД (mysqldump) в storage/app/backups';

    public function handle(): int
    {
        $disk = storage_path('app/backups');
        File::ensureDirectoryExists($disk);

        $database = config('database.connections.mysql.database');
        $username = config('database.connections.mysql.username');
        $password = config('database.connections.mysql.password');
        $host = config('database.connections.mysql.host');
        $port = config('database.connections.mysql.port');

        $fileName = sprintf('%s_%s.sql', $database, now()->format('Y-m-d_His'));
        $path = $disk.DIRECTORY_SEPARATOR.$fileName;

        $passwordPart = $password !== '' && $password !== null ? '-p'.escapeshellarg($password) : '';

        $command = sprintf(
            'mysqldump --host=%s --port=%s --user=%s %s --single-transaction --routines --triggers %s > %s',
            escapeshellarg($host),
            escapeshellarg((string) $port),
            escapeshellarg($username),
            $passwordPart,
            escapeshellarg($database),
            escapeshellarg($path)
        );

        $this->info('Создание резервной копии: '.$fileName);
        exec($command, $output, $resultCode);

        if ($resultCode !== 0) {
            $this->error('Ошибка при создании резервной копии (код '.$resultCode.'). Убедитесь, что mysqldump доступен в PATH.');
            return self::FAILURE;
        }

        // Храним последние 14 копий
        $backups = collect(File::files($disk))->sortByDesc(fn ($f) => $f->getMTime())->values();
        $backups->slice(14)->each(fn ($f) => File::delete($f->getPathname()));

        $this->info('Готово: '.$path);
        return self::SUCCESS;
    }
}
