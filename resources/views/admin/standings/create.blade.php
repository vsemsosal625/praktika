@extends('admin.layout')
@section('title', 'Новая строка таблицы')

@section('admin')
    <h2>Новая строка турнирной таблицы</h2>
    <form action="<?php echo e(route('admin.standings.store')); ?>" method="POST">
        @csrf
        @include('admin.standings._form')
        <button class="btn btn-primary" type="submit">Создать</button>
        <a href="<?php echo e(route('admin.standings.index')); ?>">Отмена</a>
    </form>
@endsection
