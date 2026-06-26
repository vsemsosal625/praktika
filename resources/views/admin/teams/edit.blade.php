@extends('admin.layout')
@section('title', 'Редактирование команды')

@section('admin')
    <h2>Редактирование</h2>
    <form action="<?php echo e(route('admin.teams.update', $team)); ?>" method="POST">
        @csrf @method('PUT')
        @include('admin.teams._form')
        <button class="btn btn-primary" type="submit">Сохранить</button>
        <a href="<?php echo e(route('admin.teams.index')); ?>">Отмена</a>
    </form>
@endsection
