<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Sport;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;

// Справочник видов спорта (ТЗ п.4.1, админ)
class SportController extends Controller
{
    public function index()
    {
        $sports = Sport::withCount(['tournaments', 'teams', 'athletes'])->orderBy('name')->paginate(20);

        return view('admin.sports.index', compact('sports'));
    }

    public function create()
    {
        return view('admin.sports.create', ['sport' => new Sport()]);
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'icon' => ['nullable', 'string', 'max:50'],
            'description' => ['nullable', 'string', 'max:1000'],
        ]);
        $data['slug'] = Str::slug($data['name']);

        Sport::create($data);

        return redirect()->route('admin.sports.index')->with('status', 'Вид спорта добавлен.');
    }

    public function edit(Sport $sport)
    {
        return view('admin.sports.edit', compact('sport'));
    }

    public function update(Request $request, Sport $sport)
    {
        $data = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'icon' => ['nullable', 'string', 'max:50'],
            'description' => ['nullable', 'string', 'max:1000'],
        ]);
        $data['slug'] = Str::slug($data['name']);

        $sport->update($data);

        return redirect()->route('admin.sports.index')->with('status', 'Вид спорта обновлён.');
    }

    public function destroy(Sport $sport)
    {
        $sport->delete();

        return back()->with('status', 'Вид спорта удалён.');
    }
}
