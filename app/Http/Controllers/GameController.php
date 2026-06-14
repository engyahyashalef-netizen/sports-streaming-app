<?php

namespace App\Http\Controllers;

use App\Models\Game;
use App\Models\Team;
use App\Models\Channel;
use Illuminate\Http\Request;

class GameController extends Controller
{
    public function index()
    {
        $games = Game::with(['teamA', 'teamB', 'channel'])->orderBy('start_time', 'desc')->paginate(15);
        return view('games.index', compact('games'));
    }

    public function create()
    {
        $teams = Team::all();
        $channels = Channel::where('is_active', true)->get();
        return view('games.create', compact('teams', 'channels'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'team_a_id' => 'required|exists:teams,id',
            'team_b_id' => 'required|exists:teams,id|different:team_a_id',
            'channel_id' => 'required|exists:channels,id',
            'start_time' => 'required|date_format:Y-m-d H:i',
            'status' => 'required|in:upcoming,live,finished',
            'description' => 'nullable|string',
        ]);

        Game::create($validated);
        return redirect()->route('games.index')->with('success', 'تم إنشاء المباراة بنجاح');
    }

    public function show(Game $game)
    {
        $game->load(['teamA', 'teamB', 'channel']);
        return view('games.show', compact('game'));
    }

    public function edit(Game $game)
    {
        $teams = Team::all();
        $channels = Channel::where('is_active', true)->get();
        return view('games.edit', compact('game', 'teams', 'channels'));
    }

    public function update(Request $request, Game $game)
    {
        $validated = $request->validate([
            'team_a_id' => 'required|exists:teams,id',
            'team_b_id' => 'required|exists:teams,id|different:team_a_id',
            'channel_id' => 'required|exists:channels,id',
            'start_time' => 'required|date_format:Y-m-d H:i',
            'status' => 'required|in:upcoming,live,finished',
            'score_a' => 'nullable|string',
            'score_b' => 'nullable|string',
            'description' => 'nullable|string',
        ]);

        $game->update($validated);
        return redirect()->route('games.show', $game)->with('success', 'تم تحديث المباراة بنجاح');
    }

    public function destroy(Game $game)
    {
        $game->delete();
        return redirect()->route('games.index')->with('success', 'تم حذف المباراة بنجاح');
    }

    public function live()
    {
        $liveGames = Game::where('status', 'live')->with(['teamA', 'teamB', 'channel'])->get();
        return view('games.live', compact('liveGames'));
    }

    public function upcoming()
    {
        $upcomingGames = Game::where('status', 'upcoming')->with(['teamA', 'teamB', 'channel'])->orderBy('start_time')->paginate(10);
        return view('games.upcoming', compact('upcomingGames'));
    }
}
