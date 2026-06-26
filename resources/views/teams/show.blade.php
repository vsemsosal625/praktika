@extends('layouts.app')
@section('title', $team->name)

@section('content')
    @if ($team->logo)<img src="<?php echo e($team->logo); ?>" alt="" style="height:90px;">@endif
    <span class="badge"><?php echo e($team->sport->name); ?></span>
    <h1 class="page-title"><?php echo e($team->name); ?></h1>
    <p class="meta"><?php echo e($team->city); ?>, <?php echo e($team->country); ?> @if ($team->founded_year)&middot; основана в <?php echo e($team->founded_year); ?>@endif</p>
    @if ($team->description)<p><?php echo e($team->description); ?></p>@endif

    <h2 class="section-title">Состав команды</h2>
    <div class="grid grid-3">
        @forelse ($team->athletes as $athlete)
            <div class="card"><div class="card-body">
                <h3><a href="<?php echo e(route('athletes.show', $athlete)); ?>"><?php echo e($athlete->name); ?></a></h3>
                <p class="meta"><?php echo e($athlete->position); ?></p>
            </div></div>
        @empty
            <p>Спортсмены не указаны.</p>
        @endforelse
    </div>
@endsection
