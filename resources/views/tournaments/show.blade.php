@extends('layouts.app')
@section('title', $tournament->name)

@section('content')
    <span class="badge"><?php echo e($tournament->sport->name); ?></span>
    <h1 class="page-title"><?php echo e($tournament->name); ?></h1>
    <p class="meta"><?php echo e($tournament->country); ?> &middot; Сезон <?php echo e($tournament->season); ?></p>
    @if ($tournament->description)<p><?php echo e($tournament->description); ?></p>@endif

    <h2 class="section-title">Турнирная таблица</h2>
    <table class="table">
        <thead><tr><th>#</th><th>Команда</th><th>И</th><th>В</th><th>Н</th><th>П</th><th>Мячи</th><th>О</th></tr></thead>
        <tbody>
        @forelse ($tournament->standings as $s)
            <tr>
                <td><?php echo e($s->position); ?></td>
                <td><a href="<?php echo e(route('teams.show', $s->team)); ?>"><?php echo e($s->team->name); ?></a></td>
                <td><?php echo e($s->played); ?></td>
                <td><?php echo e($s->won); ?></td>
                <td><?php echo e($s->drawn); ?></td>
                <td><?php echo e($s->lost); ?></td>
                <td><?php echo e($s->goals_for); ?>:<?php echo e($s->goals_against); ?></td>
                <td><strong><?php echo e($s->points); ?></strong></td>
            </tr>
        @empty
            <tr><td colspan="8">Турнирная таблица пока пуста.</td></tr>
        @endforelse
        </tbody>
    </table>

    <h2 class="section-title">Расписание матчей</h2>
    <table class="table">
        <tbody>
        @forelse ($upcoming as $m)
            <tr><td><?php echo e($m->scheduled_at->format('d.m.Y H:i')); ?></td><td><?php echo e($m->homeTeam->name); ?> — <?php echo e($m->awayTeam->name); ?></td><td><?php echo e($m->venue); ?></td></tr>
        @empty
            <tr><td>Нет запланированных матчей.</td></tr>
        @endforelse
        </tbody>
    </table>

    <h2 class="section-title">Архив результатов</h2>
    <table class="table">
        <tbody>
        @forelse ($results as $m)
            <tr><td><?php echo e($m->scheduled_at->format('d.m.Y')); ?></td><td><?php echo e($m->homeTeam->name); ?> <strong><?php echo e($m->home_score); ?>:<?php echo e($m->away_score); ?></strong> <?php echo e($m->awayTeam->name); ?></td></tr>
        @empty
            <tr><td>Результатов пока нет.</td></tr>
        @endforelse
        </tbody>
    </table>
@endsection
