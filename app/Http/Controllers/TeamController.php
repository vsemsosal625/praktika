<?php

namespace App\Http\Controllers;

use App\Models\Sport;
use App\Models\Team;
use Illuminate\Http\Request;

class TeamController extends Controller
{
    public function index(Request $request)
    {
        $validated = $request->validate([
            'sport' => ['nullable', 'string', 'exists:sports,slug'],
            'country' => ['nullable', 'string', 'max:100'],
        ]);

        $query = Team::with('sport');
        if (! empty($validated['sport'])) {
            $query->whereHas('sport', fn ($q) => $q->where('slug', $validated['sport']));
        }
        if (! empty($validated['country'])) {
            $query->where('country', 'like', '%'.$validated['country'].'%');
        }

        $teams = $query->orderBy('name')->paginate(12)->withQueryString();
        $sports = Sport::orderBy('name')->get();

        return view('teams.index', compact('teams', 'sports', 'validated'));
    }

    public function show(Team $team)
    {
        $team->load(['sport', 'athletes']);

        return view('teams.show', compact('team'));
    }
}
