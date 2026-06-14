@extends('layouts.app')

@section('title', 'لوحة التحكم')

@section('content')
<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-12">
    <!-- Stats Cards -->
    <div class="bg-gray-800 rounded-lg p-6 border border-gray-700">
        <div class="flex items-center justify-between">
            <div>
                <p class="text-gray-400 text-sm">المباريات المباشرة</p>
                <p class="text-3xl font-bold text-red-500">{{ \App\Models\Game::where('status', 'live')->count() }}</p>
            </div>
            <i class="fas fa-video text-4xl text-red-500 opacity-20"></i>
        </div>
    </div>

    <div class="bg-gray-800 rounded-lg p-6 border border-gray-700">
        <div class="flex items-center justify-between">
            <div>
                <p class="text-gray-400 text-sm">المباريات القادمة</p>
                <p class="text-3xl font-bold text-blue-500">{{ \App\Models\Game::where('status', 'upcoming')->count() }}</p>
            </div>
            <i class="fas fa-calendar text-4xl text-blue-500 opacity-20"></i>
        </div>
    </div>

    <div class="bg-gray-800 rounded-lg p-6 border border-gray-700">
        <div class="flex items-center justify-between">
            <div>
                <p class="text-gray-400 text-sm">إجمالي القنوات</p>
                <p class="text-3xl font-bold text-green-500">{{ \App\Models\Channel::count() }}</p>
            </div>
            <i class="fas fa-tv text-4xl text-green-500 opacity-20"></i>
        </div>
    </div>

    <div class="bg-gray-800 rounded-lg p-6 border border-gray-700">
        <div class="flex items-center justify-between">
            <div>
                <p class="text-gray-400 text-sm">إجمالي الفرق</p>
                <p class="text-3xl font-bold text-yellow-500">{{ \App\Models\Team::count() }}</p>
            </div>
            <i class="fas fa-users text-4xl text-yellow-500 opacity-20"></i>
        </div>
    </div>
</div>

<!-- Live Games Section -->
<div class="mb-12">
    <div class="flex justify-between items-center mb-6">
        <h2 class="text-3xl font-bold">المباريات المباشرة الآن</h2>
        <a href="{{ route('games.live') }}" class="text-red-500 hover:text-red-400">عرض الكل →</a>
    </div>

    @php
        $liveGames = \App\Models\Game::where('status', 'live')->with(['teamA', 'teamB', 'channel'])->get();
    @endphp

    @if($liveGames->count() > 0)
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            @foreach($liveGames as $game)
                <a href="{{ route('watch', $game) }}" class="bg-gray-800 rounded-lg overflow-hidden border border-gray-700 hover:border-red-500 transition group">
                    <div class="relative bg-black h-40 flex items-center justify-center">
                        <div class="absolute top-2 right-2 bg-red-500 text-white px-3 py-1 rounded text-sm font-bold">
                            <i class="fas fa-circle animate-pulse"></i> مباشر
                        </div>
                        <i class="fas fa-play-circle text-4xl text-red-500 group-hover:scale-110 transition"></i>
                    </div>
                    <div class="p-4">
                        <div class="flex justify-between items-center mb-3">
                            <div class="text-center flex-1">
                                <p class="font-bold">{{ $game->teamA->name }}</p>
                            </div>
                            <p class="text-2xl font-bold text-gray-400 px-3">{{ $game->score_a ?? '-' }}</p>
                            <p class="text-2xl font-bold text-gray-400 px-3">{{ $game->score_b ?? '-' }}</p>
                            <div class="text-center flex-1">
                                <p class="font-bold">{{ $game->teamB->name }}</p>
                            </div>
                        </div>
                        <p class="text-sm text-gray-400">{{ $game->channel->name }}</p>
                    </div>
                </a>
            @endforeach
        </div>
    @else
        <div class="bg-gray-800 rounded-lg p-8 text-center border border-gray-700">
            <i class="fas fa-inbox text-4xl text-gray-600 mb-4"></i>
            <p class="text-gray-400">لا توجد مباريات مباشرة الآن</p>
        </div>
    @endif
</div>

<!-- Upcoming Games Section -->
<div>
    <div class="flex justify-between items-center mb-6">
        <h2 class="text-3xl font-bold">المباريات القادمة</h2>
        <a href="{{ route('games.upcoming') }}" class="text-blue-500 hover:text-blue-400">عرض الكل →</a>
    </div>

    @php
        $upcomingGames = \App\Models\Game::where('status', 'upcoming')->with(['teamA', 'teamB', 'channel'])->orderBy('start_time')->limit(6)->get();
    @endphp

    @if($upcomingGames->count() > 0)
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            @foreach($upcomingGames as $game)
                <div class="bg-gray-800 rounded-lg p-6 border border-gray-700 hover:border-blue-500 transition">
                    <div class="flex justify-between items-start mb-4">
                        <div>
                            <p class="text-sm text-gray-400">{{ $game->start_time->format('d M Y') }}</p>
                            <p class="text-lg font-bold">{{ $game->start_time->format('H:i') }}</p>
                        </div>
                        <span class="bg-blue-500 text-white px-3 py-1 rounded text-sm">قادمة</span>
                    </div>
                    <div class="flex justify-between items-center mb-4">
                        <div class="text-center flex-1">
                            <p class="font-bold">{{ $game->teamA->name }}</p>
                        </div>
                        <p class="text-gray-400 px-4">vs</p>
                        <div class="text-center flex-1">
                            <p class="font-bold">{{ $game->teamB->name }}</p>
                        </div>
                    </div>
                    <p class="text-sm text-gray-400 text-center">{{ $game->channel->name }}</p>
                </div>
            @endforeach
        </div>
    @else
        <div class="bg-gray-800 rounded-lg p-8 text-center border border-gray-700">
            <i class="fas fa-inbox text-4xl text-gray-600 mb-4"></i>
            <p class="text-gray-400">لا توجد مباريات قادمة</p>
        </div>
    @endif
</div>
@endsection
