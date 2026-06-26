<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Athlete;
use App\Models\Sport;
use App\Models\Team;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

// Управление спортсменами (ТЗ п.4.1, админ)
class AthleteController extends Controller
{
    public function index()
    {
        $athletes = Athlete::with(['sport', 'team'])->orderBy('name')->paginate(20);

        return view('admin.athletes.index', compact('athletes'));
    }

    public function create()
    {
        return view('admin.athletes.create', [
            'athlete' => new Athlete(),
            'sports' => Sport::orderBy('name')->get(),
            'teams' => Team::orderBy('name')->get(),
        ]);
    }

    public function store(Request $request)
    {
        $data = $this->validateData($request);
        $data['slug'] = Str::slug($data['name']).'-'.Str::random(5);

        Athlete::create($data);

        return redirect()->route('admin.athletes.index')->with('status', 'Спортсмен добавлен.');
    }

    public function edit(Athlete $athlete)
    {
        return view('admin.athletes.edit', [
            'athlete' => $athlete,
            'sports' => Sport::orderBy('name')->get(),
            'teams' => Team::orderBy('name')->get(),
        ]);
    }

    public function update(Request $request, Athlete $athlete)
    {
        $athlete->update($this->validateData($request));

        return redirect()->route('admin.athletes.index')->with('status', 'Спортсмен обновлён.');
    }

    public function destroy(Athlete $athlete)
    {
        $athlete->delete();

        return back()->with('status', 'Спортсмен удалён.');
    }

    private function validateData(Request $request): array
    {
        return $request->validate([
            'sport_id' => ['required', 'exists:sports,id'],
            'team_id' => ['nullable', 'exists:teams,id'],
            'name' => ['required', 'string', 'max:255'],
            'country' => ['nullable', 'string', 'max:100'],
            'birth_date' => ['nullable', 'date'],
            'position' => ['nullable', 'string', 'max:100'],
            'photo' => ['nullable', 'url', 'max:500'],
            'bio' => ['nullable', 'string', 'max:2000'],
        ]);
    }
}
