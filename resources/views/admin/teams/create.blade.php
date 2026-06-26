@extends('admin.layout')
@section('title', 'Новая команда')

@section('admin')
    <h2>Новая команда</h2>
    <form action="<?php echo e(route('admin.teams.store')); ?>" method="POST">
        @csrf
        @include('admin.teams._form')
        <button class="btn btn-primary" type="submit">Создать</button>
        <a href="<?php echo e(route('admin.teams.index')); ?>">Отмена</a>
    </form>
@endsection
