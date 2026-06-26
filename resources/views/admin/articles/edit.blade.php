@extends('admin.layout')
@section('title', 'Редактирование статьи')

@section('admin')
    <h2>Редактирование статьи</h2>
    <form action="<?php echo e(route('admin.articles.update', $article)); ?>" method="POST">
        @csrf
        @method('PUT')
        @include('admin.articles._form')
        <button class="btn btn-primary" type="submit">Сохранить</button>
        <a href="<?php echo e(route('admin.articles.index')); ?>">Отмена</a>
    </form>
@endsection
