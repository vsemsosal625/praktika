@extends('admin.layout')
@section('title', 'Редактирование матча')

@section('admin')
    <h2>Редактирование матча</h2>
    <form action="<?php echo e(route('admin.matches.update', $match)); ?>" method="POST">
        @csrf @method('PUT')
        @include('admin.matches._form')
        <button class="btn btn-primary" type="submit">Сохранить</button>
        <a href="<?php echo e(route('admin.matches.index')); ?>">Отмена</a>
    </form>
@endsection
