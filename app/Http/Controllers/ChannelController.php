<?php

namespace App\Http\Controllers;

use App\Models\Channel;
use Illuminate\Http\Request;

class ChannelController extends Controller
{
    public function index()
    {
        $channels = Channel::paginate(15);
        return view('channels.index', compact('channels'));
    }

    public function create()
    {
        return view('channels.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'stream_url' => 'required|url',
            'logo' => 'nullable|url',
            'description' => 'nullable|string',
            'is_active' => 'boolean',
        ]);

        Channel::create($validated);
        return redirect()->route('channels.index')->with('success', 'تم إنشاء القناة بنجاح');
    }

    public function show(Channel $channel)
    {
        $channel->load('games');
        return view('channels.show', compact('channel'));
    }

    public function edit(Channel $channel)
    {
        return view('channels.edit', compact('channel'));
    }

    public function update(Request $request, Channel $channel)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'stream_url' => 'required|url',
            'logo' => 'nullable|url',
            'description' => 'nullable|string',
            'is_active' => 'boolean',
        ]);

        $channel->update($validated);
        return redirect()->route('channels.show', $channel)->with('success', 'تم تحديث القناة بنجاح');
    }

    public function destroy(Channel $channel)
    {
        $channel->delete();
        return redirect()->route('channels.index')->with('success', 'تم حذف القناة بنجاح');
    }
}
