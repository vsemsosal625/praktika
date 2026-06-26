@extends('admin.layout')
@section('title', 'Новая статья')

@section('admin')
    <h2>Новая статья</h2>
    <form action="<?php echo e(route('admin.articles.store')); ?>" method="POST">
        @csrf
        @include('admin.articles._form')
        <button class="btn btn-primary" type="submit">Создать</button>
        <a href="<?php echo e(route('admin.articles.index')); ?>">Отмена</a>
    </form>
@endsection
