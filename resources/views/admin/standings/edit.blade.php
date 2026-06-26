@extends('admin.layout')
@section('title', 'Редактирование строки')

@section('admin')
    <h2>Редактирование строки</h2>
    <form action="<?php echo e(route('admin.standings.update', $standing)); ?>" method="POST">
        @csrf @method('PUT')
        @include('admin.standings._form')
        <button class="btn btn-primary" type="submit">Сохранить</button>
        <a href="<?php echo e(route('admin.standings.index')); ?>">Отмена</a>
    </form>
@endsection
