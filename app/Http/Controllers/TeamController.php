<?php

namespace App\Http\Controllers;

use App\Models\Team;
use Illuminate\Http\Request;

class TeamController extends Controller
{
    public function index()
    {
        $teams = Team::paginate(15);
        return view('teams.index', compact('teams'));
    }

    public function create()
    {
        return view('teams.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255|unique:teams',
            'logo' => 'nullable|url',
            'description' => 'nullable|string',
        ]);

        Team::create($validated);
        return redirect()->route('teams.index')->with('success', 'تم إنشاء الفريق بنجاح');
    }

    public function show(Team $team)
    {
        $team->load(['homeGames', 'awayGames']);
        return view('teams.show', compact('team'));
    }

    public function edit(Team $team)
    {
        return view('teams.edit', compact('team'));
    }

    public function update(Request $request, Team $team)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255|unique:teams,name,' . $team->id,
            'logo' => 'nullable|url',
            'description' => 'nullable|string',
        ]);

        $team->update($validated);
        return redirect()->route('teams.show', $team)->with('success', 'تم تحديث الفريق بنجاح');
    }

    public function destroy(Team $team)
    {
        $team->delete();
        return redirect()->route('teams.index')->with('success', 'تم حذف الفريق بنجاح');
    }
}
