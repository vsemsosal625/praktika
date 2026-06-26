@extends('admin.layout')
@section('title', 'Редактирование турнира')

@section('admin')
    <h2>Редактирование</h2>
    <form action="<?php echo e(route('admin.tournaments.update', $tournament)); ?>" method="POST">
        @csrf @method('PUT')
        @include('admin.tournaments._form')
        <button class="btn btn-primary" type="submit">Сохранить</button>
        <a href="<?php echo e(route('admin.tournaments.index')); ?>">Отмена</a>
    </form>
@endsection
