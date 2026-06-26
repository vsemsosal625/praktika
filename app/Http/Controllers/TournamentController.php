<?php

namespace App\Http\Controllers;

use App\Models\MatchGame;
use App\Models\Sport;
use App\Models\Tournament;
use Illuminate\Http\Request;

class TournamentController extends Controller
{
    // Список турниров с фильтрацией по виду спорта/стране (ТЗ п.4.1)
    public function index(Request $request)
    {
        $validated = $request->validate([
            'sport' => ['nullable', 'string', 'exists:sports,slug'],
            'country' => ['nullable', 'string', 'max:100'],
        ]);

        $query = Tournament::with('sport');
        if (! empty($validated['sport'])) {
            $query->whereHas('sport', fn ($q) => $q->where('slug', $validated['sport']));
        }
        if (! empty($validated['country'])) {
            $query->where('country', 'like', '%'.$validated['country'].'%');
        }

        $tournaments = $query->orderBy('name')->paginate(12)->withQueryString();
        $sports = Sport::orderBy('name')->get();

        return view('tournaments.index', compact('tournaments', 'sports', 'validated'));
    }

    // Турнирная таблица + расписание + архив результатов
    public function show(Tournament $tournament)
    {
        $tournament->load(['sport', 'standings.team']);

        $upcoming = MatchGame::with(['homeTeam', 'awayTeam'])
            ->where('tournament_id', $tournament->id)
            ->where('status', '!=', 'finished')
            ->orderBy('scheduled_at')->get();

        $results = MatchGame::with(['homeTeam', 'awayTeam'])
            ->where('tournament_id', $tournament->id)
            ->where('status', 'finished')
            ->latest('scheduled_at')->get();

        return view('tournaments.show', compact('tournament', 'upcoming', 'results'));
    }
}
