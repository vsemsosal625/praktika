<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Standing;
use App\Models\Team;
use App\Models\Tournament;
use Illuminate\Http\Request;

// Турнирные таблицы / рейтинги (ТЗ п.4.1, админ)
class StandingController extends Controller
{
    public function index()
    {
        $standings = Standing::with(['tournament', 'team'])->orderBy('tournament_id')->orderBy('position')->paginate(30);

        return view('admin.standings.index', compact('standings'));
    }

    public function create()
    {
        return view('admin.standings.create', [
            'standing' => new Standing(),
            'tournaments' => Tournament::orderBy('name')->get(),
            'teams' => Team::orderBy('name')->get(),
        ]);
    }

    public function store(Request $request)
    {
        Standing::create($this->validateData($request));

        return redirect()->route('admin.standings.index')->with('status', 'Строка таблицы добавлена.');
    }

    public function edit(Standing $standing)
    {
        return view('admin.standings.edit', [
            'standing' => $standing,
            'tournaments' => Tournament::orderBy('name')->get(),
            'teams' => Team::orderBy('name')->get(),
        ]);
    }

    public function update(Request $request, Standing $standing)
    {
        $standing->update($this->validateData($request));

        return redirect()->route('admin.standings.index')->with('status', 'Строка таблицы обновлена.');
    }

    public function destroy(Standing $standing)
    {
        $standing->delete();

        return back()->with('status', 'Строка таблицы удалена.');
    }

    private function validateData(Request $request): array
    {
        return $request->validate([
            'tournament_id' => ['required', 'exists:tournaments,id'],
            'team_id' => ['required', 'exists:teams,id'],
            'position' => ['required', 'integer', 'min:0'],
            'played' => ['required', 'integer', 'min:0'],
            'won' => ['required', 'integer', 'min:0'],
            'drawn' => ['required', 'integer', 'min:0'],
            'lost' => ['required', 'integer', 'min:0'],
            'goals_for' => ['required', 'integer', 'min:0'],
            'goals_against' => ['required', 'integer', 'min:0'],
            'points' => ['required', 'integer'],
        ]);
    }
}
