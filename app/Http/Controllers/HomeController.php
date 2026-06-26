<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\MatchGame;
use App\Models\Sport;
use App\Models\Tournament;

class HomeController extends Controller
{
    // Главная: лента новостей + ближайшие матчи (роль Гость)
    public function index()
    {
        $featured = Article::published()->with(['sport', 'author'])
            ->latest('published_at')->first();

        $articles = Article::published()->with(['sport', 'author'])
            ->when($featured, fn ($q) => $q->whereKeyNot($featured->id))
            ->latest('published_at')->take(6)->get();

        $upcomingMatches = MatchGame::with(['homeTeam', 'awayTeam', 'tournament'])
            ->where('status', 'scheduled')
            ->where('scheduled_at', '>=', now())
            ->orderBy('scheduled_at')->take(5)->get();

        $recentResults = MatchGame::with(['homeTeam', 'awayTeam', 'tournament'])
            ->where('status', 'finished')
            ->latest('scheduled_at')->take(5)->get();

        $sports = Sport::orderBy('name')->get();
        $tournaments = Tournament::with('sport')->latest()->take(6)->get();

        return view('home', compact(
            'featured', 'articles', 'upcomingMatches', 'recentResults', 'sports', 'tournaments'
        ));
    }
}
