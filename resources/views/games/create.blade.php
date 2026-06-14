@extends('layouts.app')

@section('title', 'إضافة مباراة جديدة')

@section('content')
<div class="max-w-2xl mx-auto">
    <h1 class="text-3xl font-bold mb-6">إضافة مباراة جديدة</h1>

    <form action="{{ route('games.store') }}" method="POST" class="bg-gray-800 rounded-lg p-6 border border-gray-700">
        @csrf

        <div class="mb-6">
            <label class="block text-sm font-bold mb-2">الفريق الأول</label>
            <select name="team_a_id" class="w-full bg-gray-700 border border-gray-600 rounded px-4 py-2 text-white" required>
                <option value="">اختر فريقاً</option>
                @foreach($teams as $team)
                    <option value="{{ $team->id }}">{{ $team->name }}</option>
                @endforeach
            </select>
            @error('team_a_id')<p class="text-red-500 text-sm mt-1">{{ $message }}</p>@enderror
        </div>

        <div class="mb-6">
            <label class="block text-sm font-bold mb-2">الفريق الثاني</label>
            <select name="team_b_id" class="w-full bg-gray-700 border border-gray-600 rounded px-4 py-2 text-white" required>
                <option value="">اختر فريقاً</option>
                @foreach($teams as $team)
                    <option value="{{ $team->id }}">{{ $team->name }}</option>
                @endforeach
            </select>
            @error('team_b_id')<p class="text-red-500 text-sm mt-1">{{ $message }}</p>@enderror
        </div>

        <div class="mb-6">
            <label class="block text-sm font-bold mb-2">القناة</label>
            <select name="channel_id" class="w-full bg-gray-700 border border-gray-600 rounded px-4 py-2 text-white" required>
                <option value="">اختر قناة</option>
                @foreach($channels as $channel)
                    <option value="{{ $channel->id }}">{{ $channel->name }}</option>
                @endforeach
            </select>
            @error('channel_id')<p class="text-red-500 text-sm mt-1">{{ $message }}</p>@enderror
        </div>

        <div class="mb-6">
            <label class="block text-sm font-bold mb-2">وقت البداية</label>
            <input type="datetime-local" name="start_time" class="w-full bg-gray-700 border border-gray-600 rounded px-4 py-2 text-white" required>
            @error('start_time')<p class="text-red-500 text-sm mt-1">{{ $message }}</p>@enderror
        </div>

        <div class="mb-6">
            <label class="block text-sm font-bold mb-2">الحالة</label>
            <select name="status" class="w-full bg-gray-700 border border-gray-600 rounded px-4 py-2 text-white" required>
                <option value="upcoming">قادمة</option>
                <option value="live">مباشر</option>
                <option value="finished">انتهت</option>
            </select>
            @error('status')<p class="text-red-500 text-sm mt-1">{{ $message }}</p>@enderror
        </div>

        <div class="mb-6">
            <label class="block text-sm font-bold mb-2">الوصف (اختياري)</label>
            <textarea name="description" class="w-full bg-gray-700 border border-gray-600 rounded px-4 py-2 text-white" rows="4"></textarea>
            @error('description')<p class="text-red-500 text-sm mt-1">{{ $message }}</p>@enderror
        </div>

        <div class="flex gap-4">
            <button type="submit" class="bg-red-500 hover:bg-red-600 text-white px-6 py-2 rounded-lg transition">
                <i class="fas fa-save"></i> حفظ
            </button>
            <a href="{{ route('games.index') }}" class="bg-gray-700 hover:bg-gray-600 text-white px-6 py-2 rounded-lg transition">
                <i class="fas fa-times"></i> إلغاء
            </a>
        </div>
    </form>
</div>
@endsection
