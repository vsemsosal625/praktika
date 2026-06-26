@extends('layouts.app')
@section('title', 'Вход')

@section('content')
    <div class="auth-card card">
        <div class="card-body">
            <h1 class="page-title">Вход</h1>
            <form action="<?php echo e(route('login')); ?>" method="POST">
                @csrf
                <div class="form-group">
                    <label>Email</label>
                    <input type="email" name="email" value="<?php echo e(old('email')); ?>" class="form-control" required autofocus>
                </div>
                <div class="form-group">
                    <label>Пароль</label>
                    <input type="password" name="password" class="form-control" required>
                </div>
                <div class="form-group">
                    <label><input type="checkbox" name="remember"> Запомнить меня</label>
                </div>
                <button type="submit" class="btn btn-primary">Войти</button>
                <a href="<?php echo e(route('register')); ?>" style="margin-left:10px;">Создать аккаунт</a>
            </form>
        </div>
    </div>
@endsection
