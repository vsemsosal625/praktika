@extends('layouts.app')
@section('title', 'Поиск')

@section('content')
    <h1 class="page-title">Поиск</h1>
    <form action="<?php echo e(route('search')); ?>" method="GET" class="filters">
        <input type="text" name="q" value="<?php echo e($q); ?>" placeholder="Вид спорта, команда, спортсмен, турнир..." style="flex:1; min-width:240px;">
        <button class="btn btn-primary" type="submit">Найти</button>
    </form>

    @if ($q !== '')
        <h2 class="section-title">Новости</h2>
        <ul>
            @forelse ($articles as $a)<li><a href="<?php echo e(route('articles.show', $a)); ?>"><?php echo e($a->title); ?></a></li>@empty<li>Ничего не найдено.</li>@endforelse
        </ul>
        <h2 class="section-title">Турниры</h2>
        <ul>
            @forelse ($tournaments as $t)<li><a href="<?php echo e(route('tournaments.show', $t)); ?>"><?php echo e($t->name); ?></a></li>@empty<li>Ничего не найдено.</li>@endforelse
        </ul>
        <h2 class="section-title">Команды</h2>
        <ul>
            @forelse ($teams as $t)<li><a href="<?php echo e(route('teams.show', $t)); ?>"><?php echo e($t->name); ?></a></li>@empty<li>Ничего не найдено.</li>@endforelse
        </ul>
        <h2 class="section-title">Спортсмены</h2>
        <ul>
            @forelse ($athletes as $a)<li><a href="<?php echo e(route('athletes.show', $a)); ?>"><?php echo e($a->name); ?></a></li>@empty<li>Ничего не найдено.</li>@endforelse
        </ul>
    @else
        <p>Введите поисковый запрос.</p>
    @endif
@endsection
