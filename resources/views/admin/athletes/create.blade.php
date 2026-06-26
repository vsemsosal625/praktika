@extends('admin.layout')
@section('title', 'Новый спортсмен')

@section('admin')
    <h2>Новый спортсмен</h2>
    <form action="<?php echo e(route('admin.athletes.store')); ?>" method="POST">
        @csrf
        @include('admin.athletes._form')
        <button class="btn btn-primary" type="submit">Создать</button>
        <a href="<?php echo e(route('admin.athletes.index')); ?>">Отмена</a>
    </form>
@endsection
