@extends('layouts.app')
@section('title', 'Спортсмены')

@section('content')
    <h1 class="page-title">Спортсмены</h1>
    <form action="<?php echo e(route('athletes.index')); ?>" method="GET" class="filters">
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
        @forelse ($athletes as $athlete)
            <div class="card"><div class="card-body">
                @if ($athlete->photo)<img src="<?php echo e($athlete->photo); ?>" class="card-img" alt="">@endif
                <span class="badge"><?php echo e($athlete->sport->name); ?></span>
                <h3><a href="<?php echo e(route('athletes.show', $athlete)); ?>"><?php echo e($athlete->name); ?></a></h3>
                <p class="meta"><?php echo e($athlete->country); ?> @if ($athlete->team)&middot; <?php echo e($athlete->team->name); ?>@endif</p>
            </div></div>
        @empty
            <p>Спортсмены не найдены.</p>
        @endforelse
    </div>
    <div style="margin-top:24px;"><?php echo $athletes->links(); ?></div>
@endsection
