@extends('admin.layout')
@section('title', 'Новый вид спорта')

@section('admin')
    <h2>Новый вид спорта</h2>
    <form action="<?php echo e(route('admin.sports.store')); ?>" method="POST">
        @csrf
        @include('admin.sports._form')
        <button class="btn btn-primary" type="submit">Создать</button>
        <a href="<?php echo e(route('admin.sports.index')); ?>">Отмена</a>
    </form>
@endsection
