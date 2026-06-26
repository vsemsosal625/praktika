<?php

use App\Http\Controllers\ArticleController;
use App\Http\Controllers\AthleteController;
use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SearchController;
use App\Http\Controllers\TeamController;
use App\Http\Controllers\TournamentController;
use App\Http\Controllers\Admin;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Публичные маршруты (роль «Гость» — ТЗ п.4.1)
|--------------------------------------------------------------------------
*/
Route::get('/', [HomeController::class, 'index'])->name('home');

Route::get('/news', [ArticleController::class, 'index'])->name('articles.index');
Route::get('/news/{article}', [ArticleController::class, 'show'])->name('articles.show');

Route::get('/tournaments', [TournamentController::class, 'index'])->name('tournaments.index');
Route::get('/tournaments/{tournament}', [TournamentController::class, 'show'])->name('tournaments.show');

Route::get('/teams', [TeamController::class, 'index'])->name('teams.index');
Route::get('/teams/{team}', [TeamController::class, 'show'])->name('teams.show');

Route::get('/athletes', [AthleteController::class, 'index'])->name('athletes.index');
Route::get('/athletes/{athlete}', [AthleteController::class, 'show'])->name('athletes.show');

Route::get('/search', [SearchController::class, 'index'])->name('search');

/*
|--------------------------------------------------------------------------
| Аутентификация (ТЗ п.4.4)
|--------------------------------------------------------------------------
*/
Route::middleware('guest')->group(function () {
    Route::get('/register', [RegisteredUserController::class, 'create'])->name('register');
    Route::post('/register', [RegisteredUserController::class, 'store']);
    Route::get('/login', [AuthenticatedSessionController::class, 'create'])->name('login');
    Route::post('/login', [AuthenticatedSessionController::class, 'store']);
});

Route::post('/logout', [AuthenticatedSessionController::class, 'destroy'])
    ->middleware('auth')->name('logout');

/*
|--------------------------------------------------------------------------
| Роль «Пользователь» (ТЗ п.4.1): профиль и комментарии
|--------------------------------------------------------------------------
*/
Route::middleware(['auth', 'not.blocked'])->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::put('/profile/password', [ProfileController::class, 'updatePassword'])->name('profile.password');

    Route::post('/news/{article}/comments', [CommentController::class, 'store'])->name('comments.store');
    Route::patch('/comments/{comment}', [CommentController::class, 'update'])->name('comments.update');
    Route::delete('/comments/{comment}', [CommentController::class, 'destroy'])->name('comments.destroy');
});

/*
|--------------------------------------------------------------------------
| Роль «Администратор» (ТЗ п.4.1): проверка прав на сервере
|--------------------------------------------------------------------------
*/
Route::middleware(['auth', 'not.blocked', 'admin'])
    ->prefix('admin')->name('admin.')->group(function () {
        Route::get('/', [Admin\DashboardController::class, 'index'])->name('dashboard');

        Route::resource('articles', Admin\ArticleController::class)->except('show');
        Route::resource('sports', Admin\SportController::class)->except('show');
        Route::resource('tournaments', Admin\TournamentController::class)->except('show');
        Route::resource('teams', Admin\TeamController::class)->except('show');
        Route::resource('athletes', Admin\AthleteController::class)->except('show');
        Route::resource('matches', Admin\MatchController::class)->except('show')->parameters(['matches' => 'match']);
        Route::resource('standings', Admin\StandingController::class)->except('show');

        Route::get('users', [Admin\UserController::class, 'index'])->name('users.index');
        Route::patch('users/{user}/block', [Admin\UserController::class, 'toggleBlock'])->name('users.block');
        Route::patch('users/{user}/role', [Admin\UserController::class, 'toggleRole'])->name('users.role');

        Route::get('comments', [Admin\CommentController::class, 'index'])->name('comments.index');
        Route::patch('comments/{comment}', [Admin\CommentController::class, 'update'])->name('comments.update');
        Route::patch('comments/{comment}/hide', [Admin\CommentController::class, 'toggleHide'])->name('comments.hide');
        Route::delete('comments/{comment}', [Admin\CommentController::class, 'destroy'])->name('comments.destroy');
    });
