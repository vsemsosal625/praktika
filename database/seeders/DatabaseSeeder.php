<?php

namespace Database\Seeders;

use App\Models\Article;
use App\Models\Athlete;
use App\Models\Comment;
use App\Models\MatchGame;
use App\Models\Sport;
use App\Models\Standing;
use App\Models\Team;
use App\Models\Tournament;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Carbon;
use Illuminate\Support\Str;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // Администратор (пароль хешируется Argon2id через cast модели)
        $admin = User::create([
            'name' => 'Администратор',
            'email' => 'admin@sport.local',
            'password' => 'admin12345',
            'role' => 'admin',
        ]);

        $user = User::create([
            'name' => 'Иван Болельщик',
            'email' => 'user@sport.local',
            'password' => 'user12345',
            'role' => 'user',
        ]);

        // Виды спорта
        $football = Sport::create(['name' => 'Футбол', 'slug' => 'football', 'icon' => '⚽', 'description' => 'Командный вид спорта с мячом.']);
        $hockey = Sport::create(['name' => 'Хоккей', 'slug' => 'hockey', 'icon' => '🏒', 'description' => 'Игра на льду с шайбой.']);
        $basketball = Sport::create(['name' => 'Баскетбол', 'slug' => 'basketball', 'icon' => '🏀', 'description' => 'Командная игра с мячом и кольцом.']);

        // Турниры
        $rpl = Tournament::create(['name' => 'РПЛ 2025/2026', 'slug' => 'rpl-2025-2026', 'sport_id' => $football->id, 'country' => 'Россия', 'season' => '2025/2026', 'description' => 'Российская Премьер-Лига.']);
        $khl = Tournament::create(['name' => 'КХЛ 2025/2026', 'slug' => 'khl-2025-2026', 'sport_id' => $hockey->id, 'country' => 'Россия', 'season' => '2025/2026', 'description' => 'Континентальная хоккейная лига.']);

        // Команды
        $teamsData = [
            ['Зенит', $football, 'Санкт-Петербург', 1925],
            ['ЦСКА', $football, 'Москва', 1911],
            ['Спартак', $football, 'Москва', 1922],
            ['Локомотив', $football, 'Москва', 1922],
        ];
        $teams = [];
        foreach ($teamsData as $i => $t) {
            $teams[] = Team::create([
                'name' => $t[0], 'slug' => Str::slug($t[0]) . '-' . ($i + 1),
                'sport_id' => $t[1]->id, 'city' => $t[2], 'country' => 'Россия',
                'founded_year' => $t[3], 'description' => 'Футбольный клуб ' . $t[0] . '.',
            ]);
        }

        // Спортсмены
        $athletesData = [
            ['Александр Головин', 0, 'Нападающий'],
            ['Дмитрий Баринов', 1, 'Полузащитник'],
            ['Игорь Акинфеев', 2, 'Вратарь'],
            ['Сергей Петров', 3, 'Защитник'],
        ];
        foreach ($athletesData as $i => $a) {
            Athlete::create([
                'name' => $a[0], 'slug' => Str::slug($a[0]) . '-' . ($i + 1),
                'sport_id' => $football->id, 'team_id' => $teams[$a[1]]->id,
                'country' => 'Россия', 'position' => $a[2],
                'birth_date' => Carbon::create(1996, 1, 1)->addDays($i * 137),
                'bio' => 'Профессиональный спортсмен.',
            ]);
        }

        // Статьи
        $articles = [
            ['Зенит обыграл ЦСКА в центральном матче тура', 'news', true],
            ['Аналитика: как изменилась тактика топ-клубов', 'analytics', true],
            ['Анонс: дерби выходных обещает быть жарким', 'announcement', true],
            ['Черновик: итоги первого круга', 'analytics', false],
        ];
        $createdArticles = [];
        foreach ($articles as $i => $a) {
            $createdArticles[] = Article::create([
                'user_id' => $admin->id,
                'sport_id' => $football->id,
                'tournament_id' => $rpl->id,
                'title' => $a[0],
                'slug' => Str::slug($a[0]) . '-' . ($i + 1),
                'type' => $a[1],
                'excerpt' => 'Краткое описание материала «' . $a[0] . '».',
                'body' => "Подробный текст материала.\n\nЗдесь располагается основное содержание статьи о спортивном событии.",
                'is_published' => $a[2],
                'published_at' => $a[2] ? Carbon::now()->subDays($i) : null,
                'views' => rand(50, 1500),
            ]);
        }

        // Комментарии
        Comment::create(['user_id' => $user->id, 'article_id' => $createdArticles[0]->id, 'body' => 'Отличный матч, спасибо за обзор!']);
        Comment::create(['user_id' => $user->id, 'article_id' => $createdArticles[0]->id, 'body' => 'Ждём ответный матч.']);

        // Турнирная таблица
        $standingRows = [
            [0, 1, 20, 14, 4, 2, 40, 15, 46],
            [1, 2, 20, 13, 3, 4, 35, 18, 42],
            [2, 3, 20, 11, 5, 4, 33, 20, 38],
            [3, 4, 20, 9, 6, 5, 28, 22, 33],
        ];
        foreach ($standingRows as $row) {
            Standing::create([
                'tournament_id' => $rpl->id,
                'team_id' => $teams[$row[0]]->id,
                'position' => $row[1],
                'played' => $row[2], 'won' => $row[3], 'drawn' => $row[4], 'lost' => $row[5],
                'goals_for' => $row[6], 'goals_against' => $row[7], 'points' => $row[8],
            ]);
        }

        // Матчи (завершённые и запланированные)
        MatchGame::create(['tournament_id' => $rpl->id, 'home_team_id' => $teams[0]->id, 'away_team_id' => $teams[1]->id, 'scheduled_at' => Carbon::now()->subDays(3), 'home_score' => 2, 'away_score' => 1, 'status' => 'finished', 'venue' => 'Газпром Арена']);
        MatchGame::create(['tournament_id' => $rpl->id, 'home_team_id' => $teams[2]->id, 'away_team_id' => $teams[3]->id, 'scheduled_at' => Carbon::now()->subDays(2), 'home_score' => 0, 'away_score' => 0, 'status' => 'finished', 'venue' => 'Открытие Арена']);
        MatchGame::create(['tournament_id' => $rpl->id, 'home_team_id' => $teams[1]->id, 'away_team_id' => $teams[2]->id, 'scheduled_at' => Carbon::now()->addDays(4), 'status' => 'scheduled', 'venue' => 'ВЭБ Арена']);
        MatchGame::create(['tournament_id' => $rpl->id, 'home_team_id' => $teams[3]->id, 'away_team_id' => $teams[0]->id, 'scheduled_at' => Carbon::now()->addDays(7), 'status' => 'scheduled', 'venue' => 'РЖД Арена']);
    }
}
