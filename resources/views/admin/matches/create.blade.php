@extends('admin.layout')
@section('title', 'Новый матч')

@section('admin')
    <h2>Новый матч</h2>
    <form action="<?php echo e(route('admin.matches.store')); ?>" method="POST">
        @csrf
        @include('admin.matches._form')
        <button class="btn btn-primary" type="submit">Создать</button>
        <a href="<?php echo e(route('admin.matches.index')); ?>">Отмена</a>
    </form>
@endsection
