<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Sport;
use App\Models\Tournament;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

// Управление турнирами (ТЗ п.4.1, админ)
class TournamentController extends Controller
{
    public function index()
    {
        $tournaments = Tournament::with('sport')->latest()->paginate(20);

        return view('admin.tournaments.index', compact('tournaments'));
    }

    public function create()
    {
        return view('admin.tournaments.create', [
            'tournament' => new Tournament(),
            'sports' => Sport::orderBy('name')->get(),
        ]);
    }

    public function store(Request $request)
    {
        $data = $this->validateData($request);
        $data['slug'] = Str::slug($data['name']).'-'.Str::random(5);

        Tournament::create($data);

        return redirect()->route('admin.tournaments.index')->with('status', 'Турнир создан.');
    }

    public function edit(Tournament $tournament)
    {
        return view('admin.tournaments.edit', [
            'tournament' => $tournament,
            'sports' => Sport::orderBy('name')->get(),
        ]);
    }

    public function update(Request $request, Tournament $tournament)
    {
        $tournament->update($this->validateData($request));

        return redirect()->route('admin.tournaments.index')->with('status', 'Турнир обновлён.');
    }

    public function destroy(Tournament $tournament)
    {
        $tournament->delete();

        return back()->with('status', 'Турнир удалён.');
    }

    private function validateData(Request $request): array
    {
        return $request->validate([
            'sport_id' => ['required', 'exists:sports,id'],
            'name' => ['required', 'string', 'max:255'],
            'country' => ['nullable', 'string', 'max:100'],
            'season' => ['nullable', 'string', 'max:50'],
            'start_date' => ['nullable', 'date'],
            'end_date' => ['nullable', 'date', 'after_or_equal:start_date'],
            'description' => ['nullable', 'string', 'max:2000'],
        ]);
    }
}
