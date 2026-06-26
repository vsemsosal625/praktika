<?php

use App\Http\Controllers\Admin\ArticleController;
use App\Http\Controllers\Admin\AthleteController;
use App\Http\Controllers\Admin\CommentController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\MatchController;
use App\Http\Controllers\Admin\SportController;
use App\Http\Controllers\Admin\StandingController;
use App\Http\Controllers\Admin\TeamController;
use App\Http\Controllers\Admin\TournamentController;
use App\Http\Controllers\Admin\UserController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Маршруты роли «Администратор»
| Проверка прав на сервере: auth + not.blocked + admin
|--------------------------------------------------------------------------
*/
Route::middleware(['auth', 'not.blocked', 'admin'])
    ->prefix('admin')
    ->name('admin.')
    ->group(function () {
        Route::get('/', [DashboardController::class, 'index'])->name('dashboard');

        Route::resource('articles', ArticleController::class)->except('show');
        Route::resource('sports', SportController::class)->except('show');
        Route::resource('tournaments', TournamentController::class)->except('show');
        Route::resource('teams', TeamController::class)->except('show');
        Route::resource('athletes', AthleteController::class)->except('show');
        Route::resource('matches', MatchController::class)->except('show')->parameters(['matches' => 'match']);
        Route::resource('standings', StandingController::class)->except('show');

        // Управление пользователями
        Route::get('/users', [UserController::class, 'index'])->name('users.index');
        Route::patch('/users/{user}/block', [UserController::class, 'toggleBlock'])->name('users.toggleBlock');
        Route::patch('/users/{user}/role', [UserController::class, 'toggleRole'])->name('users.toggleRole');

        // Модерация комментариев
        Route::get('/comments', [CommentController::class, 'index'])->name('comments.index');
        Route::put('/comments/{comment}', [CommentController::class, 'update'])->name('comments.update');
        Route::patch('/comments/{comment}/hide', [CommentController::class, 'toggleHide'])->name('comments.toggleHide');
        Route::delete('/comments/{comment}', [CommentController::class, 'destroy'])->name('comments.destroy');
    });
