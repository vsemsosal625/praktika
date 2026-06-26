@extends('layouts.app')
@section('title', 'Главная — Спортивные соревнования')

@section('content')
    <h1 class="page-title">Лента новостей</h1>

    @if ($featured)
        <div class="card" style="margin-bottom:28px;">
            @if ($featured->image)<img src=" $featured->image " class="card-img" style="height:320px;" alt="">@endif
            <div class="card-body">
                @if ($featured->sport)<span class="badge badge-accent"> $featured->sport->name </span>@endif
                <h2 style="margin:10px 0;"><a href=" route('articles.show', $featured) "> $featured->title </a></h2>
                <p> $featured->excerpt ?? \Illuminate\Support\Str::limit(strip_tags($featured->body), 220) </p>
                <a href=" route('articles.show', $featured) " class="btn btn-primary">Читать полностью</a>
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
                        <td> $m->scheduled_at->format('d.m H:i') </td>
                        <td> $m->homeTeam->name  —  $m->awayTeam->name </td>
                        <td><a href=" route('tournaments.show', $m->tournament) "> $m->tournament->name </a></td>
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
                        <td> $m->scheduled_at->format('d.m') </td>
                        <td> $m->homeTeam->name  <strong> $m->home_score : $m->away_score </strong>  $m->awayTeam->name </td>
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
            <a href=" route('articles.index', ['sport' => $sport->slug]) " class="badge" style="color:#1e3a8a;"> $sport->icon   $sport->name </a>
        @endforeach
    </div>
@endsection
