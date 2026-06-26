@extends('admin.layout')
@section('title', 'Редактирование спортсмена')

@section('admin')
    <h2>Редактирование</h2>
    <form action="<?php echo e(route('admin.athletes.update', $athlete)); ?>" method="POST">
        @csrf @method('PUT')
        @include('admin.athletes._form')
        <button class="btn btn-primary" type="submit">Сохранить</button>
        <a href="<?php echo e(route('admin.athletes.index')); ?>">Отмена</a>
    </form>
@endsection
