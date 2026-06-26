<?php

namespace App\Http\Controllers;

use App\Models\Athlete;
use App\Models\Sport;
use Illuminate\Http\Request;

class AthleteController extends Controller
{
    public function index(Request $request)
    {
        $validated = $request->validate([
            'sport' => ['nullable', 'string', 'exists:sports,slug'],
            'country' => ['nullable', 'string', 'max:100'],
        ]);

        $query = Athlete::with(['sport', 'team']);
        if (! empty($validated['sport'])) {
            $query->whereHas('sport', fn ($q) => $q->where('slug', $validated['sport']));
        }
        if (! empty($validated['country'])) {
            $query->where('country', 'like', '%'.$validated['country'].'%');
        }

        $athletes = $query->orderBy('name')->paginate(12)->withQueryString();
        $sports = Sport::orderBy('name')->get();

        return view('athletes.index', compact('athletes', 'sports', 'validated'));
    }

    public function show(Athlete $athlete)
    {
        $athlete->load(['sport', 'team']);

        return view('athletes.show', compact('athlete'));
    }
}
