@extends('layouts.app')
@section('title', 'Поиск')

@section('content')
    <h1 class="page-title">Поиск</h1>
    <form action=" route('search') " method="GET" class="filters">
        <input type="text" name="q" value=" $q " placeholder="Вид спорта, команда, спортсмен, турнир..." style="flex:1; min-width:240px;">
        <button class="btn btn-primary" type="submit">Найти</button>
    </form>

    @if ($q !== '')
        <h2 class="section-title">Новости</h2>
        <ul>
            @forelse ($articles as $a)<li><a href=" route('articles.show', $a) "> $a->title </a></li>@empty<li>Ничего не найдено.</li>@endforelse
        </ul>
        <h2 class="section-title">Турниры</h2>
        <ul>
            @forelse ($tournaments as $t)<li><a href=" route('tournaments.show', $t) "> $t->name </a></li>@empty<li>Ничего не найдено.</li>@endforelse
        </ul>
        <h2 class="section-title">Команды</h2>
        <ul>
            @forelse ($teams as $t)<li><a href=" route('teams.show', $t) "> $t->name </a></li>@empty<li>Ничего не найдено.</li>@endforelse
        </ul>
        <h2 class="section-title">Спортсмены</h2>
        <ul>
            @forelse ($athletes as $a)<li><a href=" route('athletes.show', $a) "> $a->name </a></li>@empty<li>Ничего не найдено.</li>@endforelse
        </ul>
    @else
        <p>Введите поисковый запрос.</p>
    @endif
@endsection
