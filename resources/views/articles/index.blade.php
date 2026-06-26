@extends('layouts.app')
@section('title', 'Новости')

@section('content')
    <h1 class="page-title">Новости и аналитика</h1>

    <form action="<?php echo e(route('articles.index')); ?>" method="GET" class="filters">
        <select name="sport">
            <option value="">Все виды спорта</option>
            @foreach ($sports as $sport)
                <option value="<?php echo e($sport->slug); ?>" <?php echo e(($validated['sport'] ?? '') === $sport->slug ? 'selected' : ''); ?>><?php echo e($sport->name); ?></option>
            @endforeach
        </select>
        <select name="type">
            <option value="">Все типы</option>
            <option value="news" <?php echo e(($validated['type'] ?? '') === 'news' ? 'selected' : ''); ?>>Новости</option>
            <option value="analytics" <?php echo e(($validated['type'] ?? '') === 'analytics' ? 'selected' : ''); ?>>Аналитика</option>
            <option value="announcement" <?php echo e(($validated['type'] ?? '') === 'announcement' ? 'selected' : ''); ?>>Анонсы</option>
        </select>
        <input type="text" name="q" value="<?php echo e($validated['q'] ?? ''); ?>" placeholder="Ключевые слова...">
        <button class="btn btn-primary" type="submit">Применить</button>
    </form>

    <div class="grid grid-3">
        @forelse ($articles as $article)
            @include('partials.article-card', ['article' => $article])
        @empty
            <p>Ничего не найдено.</p>
        @endforelse
    </div>

    <div style="margin-top:24px;"><?php echo $articles->links(); ?></div>
@endsection
