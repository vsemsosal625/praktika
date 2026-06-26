@extends('admin.layout')
@section('title', 'Матчи')

@section('admin')
    <div style="display:flex; justify-content:space-between; align-items:center;">
        <h2>Матчи и результаты</h2>
        <a href="<?php echo e(route('admin.matches.create')); ?>" class="btn btn-primary">+ Добавить</a>
    </div>
    <table class="table">
        <thead><tr><th>Дата</th><th>Турнир</th><th>Матч</th><th>Счёт</th><th>Статус</th><th></th></tr></thead>
        <tbody>
        @forelse ($matches as $m)
            <tr>
                <td><?php echo e($m->scheduled_at->format('d.m.Y H:i')); ?></td>
                <td><?php echo e($m->tournament->name ?? '—'); ?></td>
                <td><?php echo e($m->homeTeam->name ?? '?'); ?> — <?php echo e($m->awayTeam->name ?? '?'); ?></td>
                <td><?php echo e($m->status === 'finished' ? $m->home_score.':'.$m->away_score : '—'); ?></td>
                <td><?php echo e($m->status); ?></td>
                <td>
                    <a href="<?php echo e(route('admin.matches.edit', $m)); ?>" class="btn btn-sm btn-light">Изм.</a>
                    <form action="<?php echo e(route('admin.matches.destroy', $m)); ?>" method="POST" style="display:inline" data-confirm="Удалить?">
                        @csrf @method('DELETE')
                        <button class="btn btn-sm btn-danger">Уд.</button>
                    </form>
                </td>
            </tr>
        @empty
            <tr><td colspan="6">Пусто.</td></tr>
        @endforelse
        </tbody>
    </table>
    <div style="margin-top:16px;"><?php echo $matches->links(); ?></div>
@endsection
