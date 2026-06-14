@extends('layouts.app')

@section('title', 'تعديل المباراة')

@section('content')
<div class="max-w-2xl mx-auto">
    <h1 class="text-3xl font-bold mb-6">تعديل المباراة</h1>

    <form action="{{ route('games.update', $game) }}" method="POST" class="bg-gray-800 rounded-lg p-6 border border-gray-700">
        @csrf
        @method('PUT')

        <div class="mb-6">
            <label class="block text-sm font-bold mb-2">الفريق الأول</label>
            <select name="team_a_id" class="w-full bg-gray-700 border border-gray-600 rounded px-4 py-2 text-white" required>
                @foreach($teams as $team)
                    <option value="{{ $team->id }}" {{ $game->team_a_id == $team->id ? 'selected' : '' }}>{{ $team->name }}</option>
                @endforeach
            </select>
            @error('team_a_id')<p class="text-red-500 text-sm mt-1">{{ $message }}</p>@enderror
        </div>

        <div class="mb-6">
            <label class="block text-sm font-bold mb-2">الفريق الثاني</label>
            <select name="team_b_id" class="w-full bg-gray-700 border border-gray-600 rounded px-4 py-2 text-white" required>
                @foreach($teams as $team)
                    <option value="{{ $team->id }}" {{ $game->team_b_id == $team->id ? 'selected' : '' }}>{{ $team->name }}</option>
                @endforeach
            </select>
            @error('team_b_id')<p class="text-red-500 text-sm mt-1">{{ $message }}</p>@enderror
        </div>

        <div class="mb-6">
            <label class="block text-sm font-bold mb-2">القناة</label>
            <select name="channel_id" class="w-full bg-gray-700 border border-gray-600 rounded px-4 py-2 text-white" required>
                @foreach($channels as $channel)
                    <option value="{{ $channel->id }}" {{ $game->channel_id == $channel->id ? 'selected' : '' }}>{{ $channel->name }}</option>
                @endforeach
            </select>
            @error('channel_id')<p class="text-red-500 text-sm mt-1">{{ $message }}</p>@enderror
        </div>

        <div class="mb-6">
            <label class="block text-sm font-bold mb-2">وقت البداية</label>
            <input type="datetime-local" name="start_time" value="{{ $game->start_time->format('Y-m-d\TH:i') }}" class="w-full bg-gray-700 border border-gray-600 rounded px-4 py-2 text-white" required>
            @error('start_time')<p class="text-red-500 text-sm mt-1">{{ $message }}</p>@enderror
        </div>

        <div class="mb-6">
            <label class="block text-sm font-bold mb-2">الحالة</label>
            <select name="status" class="w-full bg-gray-700 border border-gray-600 rounded px-4 py-2 text-white" required>
                <option value="upcoming" {{ $game->status == 'upcoming' ? 'selected' : '' }}>قادمة</option>
                <option value="live" {{ $game->status == 'live' ? 'selected' : '' }}>مباشر</option>
                <option value="finished" {{ $game->status == 'finished' ? 'selected' : '' }}>انتهت</option>
            </select>
            @error('status')<p class="text-red-500 text-sm mt-1">{{ $message }}</p>@enderror
        </div>

        <div class="grid grid-cols-2 gap-4 mb-6">
            <div>
                <label class="block text-sm font-bold mb-2">النتيجة - الفريق الأول</label>
                <input type="text" name="score_a" value="{{ $game->score_a }}" class="w-full bg-gray-700 border border-gray-600 rounded px-4 py-2 text-white" placeholder="0">
                @error('score_a')<p class="text-red-500 text-sm mt-1">{{ $message }}</p>@enderror
            </div>
            <div>
                <label class="block text-sm font-bold mb-2">النتيجة - الفريق الثاني</label>
                <input type="text" name="score_b" value="{{ $game->score_b }}" class="w-full bg-gray-700 border border-gray-600 rounded px-4 py-2 text-white" placeholder="0">
                @error('score_b')<p class="text-red-500 text-sm mt-1">{{ $message }}</p>@enderror
            </div>
        </div>

        <div class="mb-6">
            <label class="block text-sm font-bold mb-2">الوصف (اختياري)</label>
            <textarea name="description" class="w-full bg-gray-700 border border-gray-600 rounded px-4 py-2 text-white" rows="4">{{ $game->description }}</textarea>
            @error('description')<p class="text-red-500 text-sm mt-1">{{ $message }}</p>@enderror
        </div>

        <div class="flex gap-4">
            <button type="submit" class="bg-red-500 hover:bg-red-600 text-white px-6 py-2 rounded-lg transition">
                <i class="fas fa-save"></i> حفظ التغييرات
            </button>
            <a href="{{ route('games.show', $game) }}" class="bg-gray-700 hover:bg-gray-600 text-white px-6 py-2 rounded-lg transition">
                <i class="fas fa-times"></i> إلغاء
            </a>
        </div>
    </form>
</div>
@endsection
