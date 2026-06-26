<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\MatchGame;
use App\Models\Team;
use App\Models\Tournament;
use Illuminate\Http\Request;

// Результаты и расписание матчей (ТЗ п.4.1, админ)
class MatchController extends Controller
{
    public function index()
    {
        $matches = MatchGame::with(['tournament', 'homeTeam', 'awayTeam'])->latest('scheduled_at')->paginate(20);

        return view('admin.matches.index', compact('matches'));
    }

    public function create()
    {
        return view('admin.matches.create', [
            'match' => new MatchGame(),
            'tournaments' => Tournament::orderBy('name')->get(),
            'teams' => Team::orderBy('name')->get(),
        ]);
    }

    public function store(Request $request)
    {
        MatchGame::create($this->validateData($request));

        return redirect()->route('admin.matches.index')->with('status', 'Матч добавлен.');
    }

    public function edit(MatchGame $match)
    {
        return view('admin.matches.edit', [
            'match' => $match,
            'tournaments' => Tournament::orderBy('name')->get(),
            'teams' => Team::orderBy('name')->get(),
        ]);
    }

    public function update(Request $request, MatchGame $match)
    {
        $match->update($this->validateData($request));

        return redirect()->route('admin.matches.index')->with('status', 'Матч обновлён.');
    }

    public function destroy(MatchGame $match)
    {
        $match->delete();

        return back()->with('status', 'Матч удалён.');
    }

    private function validateData(Request $request): array
    {
        return $request->validate([
            'tournament_id' => ['required', 'exists:tournaments,id'],
            'home_team_id' => ['required', 'exists:teams,id'],
            'away_team_id' => ['required', 'different:home_team_id', 'exists:teams,id'],
            'scheduled_at' => ['required', 'date'],
            'status' => ['required', 'in:scheduled,live,finished'],
            'home_score' => ['nullable', 'integer', 'min:0', 'max:999'],
            'away_score' => ['nullable', 'integer', 'min:0', 'max:999'],
            'venue' => ['nullable', 'string', 'max:255'],
        ]);
    }
}
