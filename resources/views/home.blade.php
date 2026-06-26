@extends('layouts.app')
@section('title', 'Главная — Спортивные соревнования')

@section('content')
    <h1 class="page-title">Лента новостей</h1>

    @if ($featured)
        <div class="card" style="margin-bottom:28px;">
            @if ($featured->image)<img src="<?php echo e($featured->image); ?>" class="card-img" style="height:320px;" alt="">@endif
            <div class="card-body">
                @if ($featured->sport)<span class="badge badge-accent"><?php echo e($featured->sport->name); ?></span>@endif
                <h2 style="margin:10px 0;"><a href="<?php echo e(route('articles.show', $featured)); ?>"><?php echo e($featured->title); ?></a></h2>
                <p><?php echo e($featured->excerpt); ?></p>
                <a href="<?php echo e(route('articles.show', $featured)); ?>" class="btn btn-primary">Читать полностью</a>
            </div>
        </div>
    @endif

    <div class="grid grid-3">
        @forelse ($articles as $article)
            @include('partials.article-card', ['article' => $article])
        @empty
            <p>Пока нет опубликованных новостей.</p>
        @endforelse
    </div>

    <div class="grid grid-2" style="margin-top:32px;">
        <div>
            <h2 class="section-title">Ближайшие матчи</h2>
            <table class="table">
                <tbody>
                @forelse ($upcomingMatches as $m)
                    <tr>
                        <td><?php echo e($m->scheduled_at->format('d.m H:i')); ?></td>
                        <td><?php echo e($m->homeTeam->name); ?> — <?php echo e($m->awayTeam->name); ?></td>
                        <td><a href="<?php echo e(route('tournaments.show', $m->tournament)); ?>"><?php echo e($m->tournament->name); ?></a></td>
                    </tr>
                @empty
                    <tr><td>Нет запланированных матчей.</td></tr>
                @endforelse
                </tbody>
            </table>
        </div>
        <div>
            <h2 class="section-title">Последние результаты</h2>
            <table class="table">
                <tbody>
                @forelse ($recentResults as $m)
                    <tr>
                        <td><?php echo e($m->scheduled_at->format('d.m')); ?></td>
                        <td><?php echo e($m->homeTeam->name); ?> <strong><?php echo e($m->home_score); ?>:<?php echo e($m->away_score); ?></strong> <?php echo e($m->awayTeam->name); ?></td>
                    </tr>
                @empty
                    <tr><td>Нет результатов.</td></tr>
                @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <h2 class="section-title">Виды спорта</h2>
    <div class="nav-links">
        @foreach ($sports as $sport)
            <a href="<?php echo e(route('articles.index', ['sport' => $sport->slug])); ?>" class="badge" style="color:#1e3a8a;"><?php echo e($sport->icon); ?> <?php echo e($sport->name); ?></a>
        @endforeach
    </div>
@endsection
