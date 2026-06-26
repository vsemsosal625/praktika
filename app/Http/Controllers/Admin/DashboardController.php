<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Article;
use App\Models\Athlete;
use App\Models\Comment;
use App\Models\MatchGame;
use App\Models\Sport;
use App\Models\Team;
use App\Models\Tournament;
use App\Models\User;

class DashboardController extends Controller
{
    public function index()
    {
        $stats = [
            'articles' => Article::count(),
            'comments' => Comment::count(),
            'users' => User::count(),
            'sports' => Sport::count(),
            'tournaments' => Tournament::count(),
            'teams' => Team::count(),
            'athletes' => Athlete::count(),
            'matches' => MatchGame::count(),
        ];

        $latestArticles = Article::with('author')->latest()->take(5)->get();
        $latestComments = Comment::with(['user', 'article'])->latest()->take(5)->get();

        return view('admin.dashboard', compact('stats', 'latestArticles', 'latestComments'));
    }
}
