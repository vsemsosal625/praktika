<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\Athlete;
use App\Models\Team;
use App\Models\Tournament;
use Illuminate\Http\Request;

// Глобальный поиск по ключевым словам (ТЗ п.4.1, гость)
class SearchController extends Controller
{
    public function index(Request $request)
    {
        $validated = $request->validate([
            'q' => ['nullable', 'string', 'max:120'],
        ]);

        $q = trim($validated['q'] ?? '');
        $articles = $teams = $athletes = $tournaments = collect();

        if ($q !== '') {
            $term = '%'.$q.'%'; // параметризованный запрос

            $articles = Article::published()->with('sport')
                ->where(fn ($w) => $w->where('title', 'like', $term)->orWhere('body', 'like', $term))
                ->take(10)->get();
            $teams = Team::with('sport')->where('name', 'like', $term)->take(10)->get();
            $athletes = Athlete::with('sport')->where('name', 'like', $term)->take(10)->get();
            $tournaments = Tournament::with('sport')->where('name', 'like', $term)->take(10)->get();
        }

        return view('search', compact('q', 'articles', 'teams', 'athletes', 'tournaments'));
    }
}
