@extends('layouts.app')

@section('title', 'المباريات المباشرة')

@section('content')
<h1 class="text-3xl font-bold mb-6">المباريات المباشرة الآن</h1>

@if($liveGames->count() > 0)
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        @foreach($liveGames as $game)
            <a href="{{ route('watch', $game) }}" class="bg-gray-800 rounded-lg overflow-hidden border border-red-500 hover:border-red-400 transition group">
                <div class="relative bg-black h-48 flex items-center justify-center">
                    <div class="absolute top-2 right-2 bg-red-500 text-white px-3 py-1 rounded text-sm font-bold">
                        <i class="fas fa-circle animate-pulse"></i> مباشر
                    </div>
                    <i class="fas fa-play-circle text-6xl text-red-500 group-hover:scale-110 transition"></i>
                </div>
                <div class="p-6">
                    <div class="flex justify-between items-center mb-4">
                        <div class="text-center flex-1">
                            <p class="font-bold text-lg">{{ $game->teamA->name }}</p>
                        </div>
                        <div class="text-center px-4">
                            <p class="text-3xl font-bold">{{ $game->score_a ?? '-' }}</p>
                            <p class="text-gray-400 text-sm">-</p>
                            <p class="text-3xl font-bold">{{ $game->score_b ?? '-' }}</p>
                        </div>
                        <div class="text-center flex-1">
                            <p class="font-bold text-lg">{{ $game->teamB->name }}</p>
                        </div>
                    </div>
                    <p class="text-sm text-gray-400 text-center">{{ $game->channel->name }}</p>
                </div>
            </a>
        @endforeach
    </div>
@else
    <div class="bg-gray-800 rounded-lg p-12 text-center border border-gray-700">
        <i class="fas fa-inbox text-6xl text-gray-600 mb-4"></i>
        <p class="text-gray-400 text-lg">لا توجد مباريات مباشرة الآن</p>
    </div>
@endif
@endsection
