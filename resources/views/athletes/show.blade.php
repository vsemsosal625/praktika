@extends('layouts.app')
@section('title', $athlete->name)

@section('content')
    @if ($athlete->photo)<img src="<?php echo e($athlete->photo); ?>" alt="" style="max-height:220px; border-radius:12px;">@endif
    <span class="badge"><?php echo e($athlete->sport->name); ?></span>
    <h1 class="page-title"><?php echo e($athlete->name); ?></h1>
    <p class="meta">
        <?php echo e($athlete->country); ?>
        @if ($athlete->position)&middot; <?php echo e($athlete->position); ?>@endif
        @if ($athlete->birth_date)&middot; <?php echo e($athlete->birth_date->format('d.m.Y')); ?>@endif
        @if ($athlete->team)&middot; <a href="<?php echo e(route('teams.show', $athlete->team)); ?>"><?php echo e($athlete->team->name); ?></a>@endif
    </p>
    @if ($athlete->bio)<p><?php echo e($athlete->bio); ?></p>@endif
@endsection
