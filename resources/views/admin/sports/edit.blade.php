@extends('admin.layout')
@section('title', 'Редактирование вида спорта')

@section('admin')
    <h2>Редактирование</h2>
    <form action="<?php echo e(route('admin.sports.update', $sport)); ?>" method="POST">
        @csrf @method('PUT')
        @include('admin.sports._form')
        <button class="btn btn-primary" type="submit">Сохранить</button>
        <a href="<?php echo e(route('admin.sports.index')); ?>">Отмена</a>
    </form>
@endsection
