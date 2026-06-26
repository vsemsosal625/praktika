@extends('layouts.app')
@section('title', 'Регистрация')

@section('content')
    <div class="auth-card card">
        <div class="card-body">
            <h1 class="page-title">Регистрация</h1>
            <form action=" route('register') " method="POST">
                @csrf
                <div class="form-group">
                    <label>Имя</label>
                    <input type="text" name="name" value=" old('name') " class="form-control" required autofocus>
                </div>
                <div class="form-group">
                    <label>Email</label>
                    <input type="email" name="email" value=" old('email') " class="form-control" required>
                </div>
                <div class="form-group">
                    <label>Пароль</label>
                    <input type="password" name="password" class="form-control" required>
                </div>
                <div class="form-group">
                    <label>Повторите пароль</label>
                    <input type="password" name="password_confirmation" class="form-control" required>
                </div>
                <button type="submit" class="btn btn-primary">Зарегистрироваться</button>
                <a href=" route('login') " style="margin-left:10px;">Уже есть аккаунт?</a>
            </form>
        </div>
    </div>
@endsection
