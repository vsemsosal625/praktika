@extends('layouts.app')
@section('title', 'Мой профиль')

@section('content')
    <h1 class="page-title">Мой профиль</h1>

    <div class="card" style="margin-bottom:20px;"><div class="card-body">
        <h2>Основные данные</h2>
        <form action="<?php echo e(route('profile.update')); ?>" method="POST">
            @csrf
            @method('PATCH')
            <div class="form-group"><label>Имя</label><input type="text" name="name" value="<?php echo e(old('name', $user->name)); ?>" class="form-control" required></div>
            <div class="form-group"><label>Email</label><input type="email" name="email" value="<?php echo e(old('email', $user->email)); ?>" class="form-control" required></div>
            <div class="form-group"><label>О себе</label><textarea name="bio" class="form-control"><?php echo e(old('bio', $user->bio)); ?></textarea></div>
            <button class="btn btn-primary" type="submit">Сохранить</button>
        </form>
    </div></div>

    <div class="card"><div class="card-body">
        <h2>Смена пароля</h2>
        <form action="<?php echo e(route('profile.password')); ?>" method="POST">
            @csrf
            @method('PUT')
            <div class="form-group"><label>Текущий пароль</label><input type="password" name="current_password" class="form-control" required></div>
            <div class="form-group"><label>Новый пароль</label><input type="password" name="password" class="form-control" required></div>
            <div class="form-group"><label>Повторите новый пароль</label><input type="password" name="password_confirmation" class="form-control" required></div>
            <button class="btn btn-primary" type="submit">Изменить пароль</button>
        </form>
    </div></div>
@endsection
