@extends('layouts.app')

@section('title', 'المباريات القادمة')

@section('content')
<h1 class="text-3xl font-bold mb-6">المباريات القادمة</h1>

@if($upcomingGames->count() > 0)
    <div class="space-y-4">
        @foreach($upcomingGames as $game)
            <div class="bg-gray-800 rounded-lg p-6 border border-gray-700 hover:border-blue-500 transition">
                <div class="flex justify-between items-center">
                    <div class="flex-1">
                        <div class="flex justify-between items-center mb-4">
                            <div class="text-center flex-1">
                                <p class="font-bold text-xl">{{ $game->teamA->name }}</p>
                            </div>
                            <p class="text-gray-400 px-4">vs</p>
                            <div class="text-center flex-1">
                                <p class="font-bold text-xl">{{ $game->teamB->name }}</p>
                            </div>
                        </div>
                        <p class="text-sm text-gray-400 text-center mb-2">{{ $game->channel->name }}</p>
                    </div>
                    <div class="text-right ml-6">
                        <p class="text-sm text-gray-400">{{ $game->start_time->format('d M Y') }}</p>
                        <p class="text-2xl font-bold">{{ $game->start_time->format('H:i') }}</p>
                        <span class="inline-block bg-blue-500 text-white px-3 py-1 rounded text-sm mt-2">قادمة</span>
                    </div>
                </div>
            </div>
        @endforeach
    </div>

    <div class="mt-6">
        {{ $upcomingGames->links() }}
    </div>
@else
    <div class="bg-gray-800 rounded-lg p-12 text-center border border-gray-700">
        <i class="fas fa-inbox text-6xl text-gray-600 mb-4"></i>
        <p class="text-gray-400 text-lg">لا توجد مباريات قادمة</p>
    </div>
@endif
@endsection
