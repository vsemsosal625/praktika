@extends('admin.layout')
@section('title', 'Дашборд — Админка')

@section('admin')
    <div class="stat-grid">
        <div class="stat"><div class="num"><?php echo e($stats['articles']); ?></div><div class="label">Статей</div></div>
        <div class="stat"><div class="num"><?php echo e($stats['comments']); ?></div><div class="label">Комментариев</div></div>
        <div class="stat"><div class="num"><?php echo e($stats['users']); ?></div><div class="label">Пользователей</div></div>
        <div class="stat"><div class="num"><?php echo e($stats['tournaments']); ?></div><div class="label">Турниров</div></div>
        <div class="stat"><div class="num"><?php echo e($stats['teams']); ?></div><div class="label">Команд</div></div>
        <div class="stat"><div class="num"><?php echo e($stats['athletes']); ?></div><div class="label">Спортсменов</div></div>
        <div class="stat"><div class="num"><?php echo e($stats['matches']); ?></div><div class="label">Матчей</div></div>
        <div class="stat"><div class="num"><?php echo e($stats['sports']); ?></div><div class="label">Видов спорта</div></div>
    </div>

    <h2 class="section-title">Последние статьи</h2>
    <table class="table">
        <tbody>
        @foreach ($latestArticles as $a)
            <tr><td><a href="<?php echo e(route('admin.articles.edit', $a)); ?>"><?php echo e($a->title); ?></a></td><td><?php echo e($a->is_published ? 'Опубликована' : 'Черновик'); ?></td><td><?php echo e($a->created_at->format('d.m.Y')); ?></td></tr>
        @endforeach
        </tbody>
    </table>

    <h2 class="section-title">Последние комментарии</h2>
    <table class="table">
        <tbody>
        @foreach ($latestComments as $c)
            <tr><td><?php echo e($c->user->name ?? '—'); ?></td><td><?php echo e(Str::limit($c->body, 60)); ?></td><td><?php echo e($c->created_at->format('d.m.Y')); ?></td></tr>
        @endforeach
        </tbody>
    </table>
@endsection
