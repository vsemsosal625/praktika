@extends('layouts.app')
@section('title', 'Команды')

@section('content')
    <h1 class="page-title">Команды</h1>
    <form action="<?php echo e(route('teams.index')); ?>" method="GET" class="filters">
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
        @forelse ($teams as $team)
            <div class="card"><div class="card-body">
                @if ($team->logo)<img src="<?php echo e($team->logo); ?>" alt="" style="height:60px;">@endif
                <span class="badge"><?php echo e($team->sport->name); ?></span>
                <h3><a href="<?php echo e(route('teams.show', $team)); ?>"><?php echo e($team->name); ?></a></h3>
                <p class="meta"><?php echo e($team->city); ?>, <?php echo e($team->country); ?></p>
            </div></div>
        @empty
            <p>Команды не найдены.</p>
        @endforelse
    </div>
    <div style="margin-top:24px;"><?php echo $teams->links(); ?></div>
@endsection
