@extends('layouts.app')
@section('title', 'Турниры')

@section('content')
    <h1 class="page-title">Турниры и лиги</h1>

    <form action="<?php echo e(route('tournaments.index')); ?>" method="GET" class="filters">
        <select name="sport">
            <option value="">Все виды спорта</option>
            @foreach ($sports as $sport)
                <option value="<?php echo e($sport->slug); ?>" <?php echo e(($validated['sport'] ?? '') === $sport->slug ? 'selected' : ''); ?>><?php echo e($sport->name); ?></option>
            @endforeach
        </select>
        <input type="text" name="country" value="<?php echo e($validated['country'] ?? ''); ?>" placeholder="Страна">
        <button class="btn btn-primary" type="submit">Применить</button>
    </form>

    <div class="grid grid-3">
        @forelse ($tournaments as $t)
            <div class="card"><div class="card-body">
                <span class="badge"><?php echo e($t->sport->name); ?></span>
                <h3><a href="<?php echo e(route('tournaments.show', $t)); ?>"><?php echo e($t->name); ?></a></h3>
                <p class="meta"><?php echo e($t->country); ?> &middot; <?php echo e($t->season); ?></p>
            </div></div>
        @empty
            <p>Турниры не найдены.</p>
        @endforelse
    </div>
    <div style="margin-top:24px;"><?php echo $tournaments->links(); ?></div>
@endsection
