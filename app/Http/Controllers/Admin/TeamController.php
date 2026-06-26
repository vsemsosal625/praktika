<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Sport;
use App\Models\Team;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

// Управление командами (ТЗ п.4.1, админ)
class TeamController extends Controller
{
    public function index()
    {
        $teams = Team::with('sport')->orderBy('name')->paginate(20);

        return view('admin.teams.index', compact('teams'));
    }

    public function create()
    {
        return view('admin.teams.create', [
            'team' => new Team(),
            'sports' => Sport::orderBy('name')->get(),
        ]);
    }

    public function store(Request $request)
    {
        $data = $this->validateData($request);
        $data['slug'] = Str::slug($data['name']).'-'.Str::random(5);

        Team::create($data);

        return redirect()->route('admin.teams.index')->with('status', 'Команда добавлена.');
    }

    public function edit(Team $team)
    {
        return view('admin.teams.edit', [
            'team' => $team,
            'sports' => Sport::orderBy('name')->get(),
        ]);
    }

    public function update(Request $request, Team $team)
    {
        $team->update($this->validateData($request));

        return redirect()->route('admin.teams.index')->with('status', 'Команда обновлена.');
    }

    public function destroy(Team $team)
    {
        $team->delete();

        return back()->with('status', 'Команда удалена.');
    }

    private function validateData(Request $request): array
    {
        return $request->validate([
            'sport_id' => ['required', 'exists:sports,id'],
            'name' => ['required', 'string', 'max:255'],
            'country' => ['nullable', 'string', 'max:100'],
            'city' => ['nullable', 'string', 'max:100'],
            'founded_year' => ['nullable', 'integer', 'min:1800', 'max:2100'],
            'logo' => ['nullable', 'url', 'max:500'],
            'description' => ['nullable', 'string', 'max:2000'],
        ]);
    }
}
