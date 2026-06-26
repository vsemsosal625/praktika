@extends('admin.layout')
@section('title', 'Новый турнир')

@section('admin')
    <h2>Новый турнир</h2>
    <form action="<?php echo e(route('admin.tournaments.store')); ?>" method="POST">
        @csrf
        @include('admin.tournaments._form')
        <button class="btn btn-primary" type="submit">Создать</button>
        <a href="<?php echo e(route('admin.tournaments.index')); ?>">Отмена</a>
    </form>
@endsection
