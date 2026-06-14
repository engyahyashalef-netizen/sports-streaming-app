@extends('layouts.app')

@section('title', $game->teamA->name . ' vs ' . $game->teamB->name)

@section('content')
<div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
    <!-- Video Player -->
    <div class="lg:col-span-2">
        <div class="bg-black rounded-lg overflow-hidden border border-gray-700">
            <video id="videoPlayer" class="w-full" controls style="background: #000;">
                <source src="{{ $game->channel->stream_url }}" type="application/x-mpegURL">
                Your browser does not support the video tag.
            </video>
        </div>

        <!-- Game Info -->
        <div class="mt-6 bg-gray-800 rounded-lg p-6 border border-gray-700">
            <div class="flex justify-between items-center mb-4">
                <h1 class="text-3xl font-bold">{{ $game->teamA->name }} vs {{ $game->teamB->name }}</h1>
                @if($game->status === 'live')
                    <span class="bg-red-500 text-white px-4 py-2 rounded-full text-sm font-bold flex items-center">
                        <i class="fas fa-circle animate-pulse mr-2"></i> مباشر
                    </span>
                @elseif($game->status === 'upcoming')
                    <span class="bg-blue-500 text-white px-4 py-2 rounded-full text-sm font-bold">
                        قادمة
                    </span>
                @else
                    <span class="bg-gray-500 text-white px-4 py-2 rounded-full text-sm font-bold">
                        انتهت
                    </span>
                @endif
            </div>

            <div class="grid grid-cols-3 gap-4 mb-6">
                <div class="text-center">
                    @if($game->teamA->logo)
                        <img src="{{ $game->teamA->logo }}" alt="{{ $game->teamA->name }}" class="w-16 h-16 mx-auto mb-2 rounded">
                    @else
                        <div class="w-16 h-16 mx-auto mb-2 rounded bg-gray-700 flex items-center justify-center">
                            <i class="fas fa-shield-alt text-2xl"></i>
                        </div>
                    @endif
                    <p class="font-bold">{{ $game->teamA->name }}</p>
                </div>

                <div class="text-center flex items-center justify-center">
                    <div>
                        <p class="text-4xl font-bold">{{ $game->score_a ?? '-' }}</p>
                        <p class="text-gray-400 text-sm">{{ $game->start_time->format('H:i') }}</p>
                    </div>
                    <p class="text-2xl text-gray-400 mx-2">-</p>
                    <div>
                        <p class="text-4xl font-bold">{{ $game->score_b ?? '-' }}</p>
                    </div>
                </div>

                <div class="text-center">
                    @if($game->teamB->logo)
                        <img src="{{ $game->teamB->logo }}" alt="{{ $game->teamB->name }}" class="w-16 h-16 mx-auto mb-2 rounded">
                    @else
                        <div class="w-16 h-16 mx-auto mb-2 rounded bg-gray-700 flex items-center justify-center">
                            <i class="fas fa-shield-alt text-2xl"></i>
                        </div>
                    @endif
                    <p class="font-bold">{{ $game->teamB->name }}</p>
                </div>
            </div>

            <div class="border-t border-gray-700 pt-4">
                <p class="text-gray-400 mb-2"><strong>القناة:</strong> {{ $game->channel->name }}</p>
                <p class="text-gray-400 mb-2"><strong>الوقت:</strong> {{ $game->start_time->format('d M Y H:i') }}</p>
                @if($game->description)
                    <p class="text-gray-400"><strong>الوصف:</strong> {{ $game->description }}</p>
                @endif
            </div>
        </div>
    </div>

    <!-- Sidebar -->
    <div>
        <!-- Channel Info -->
        <div class="bg-gray-800 rounded-lg p-6 border border-gray-700 mb-6">
            <h3 class="text-xl font-bold mb-4">معلومات القناة</h3>
            @if($game->channel->logo)
                <img src="{{ $game->channel->logo }}" alt="{{ $game->channel->name }}" class="w-full h-32 object-cover rounded mb-4">
            @else
                <div class="w-full h-32 bg-gray-700 rounded mb-4 flex items-center justify-center">
                    <i class="fas fa-tv text-4xl text-gray-600"></i>
                </div>
            @endif
            <h4 class="font-bold text-lg mb-2">{{ $game->channel->name }}</h4>
            @if($game->channel->description)
                <p class="text-gray-400 text-sm">{{ $game->channel->description }}</p>
            @endif
        </div>

        <!-- Related Games -->
        <div class="bg-gray-800 rounded-lg p-6 border border-gray-700">
            <h3 class="text-xl font-bold mb-4">مباريات أخرى</h3>
            @php
                $relatedGames = \App\Models\Game::where('id', '!=', $game->id)
                    ->where(function($q) use ($game) {
                        $q->where('team_a_id', $game->team_a_id)
                          ->orWhere('team_b_id', $game->team_b_id)
                          ->orWhere('channel_id', $game->channel_id);
                    })
                    ->with(['teamA', 'teamB', 'channel'])
                    ->limit(5)
                    ->get();
            @endphp

            @if($relatedGames->count() > 0)
                <div class="space-y-3">
                    @foreach($relatedGames as $related)
                        <a href="{{ route('watch', $related) }}" class="block p-3 bg-gray-700 rounded hover:bg-gray-600 transition">
                            <p class="text-sm font-bold">{{ $related->teamA->name }} vs {{ $related->teamB->name }}</p>
                            <p class="text-xs text-gray-400">{{ $related->start_time->format('H:i') }}</p>
                        </a>
                    @endforeach
                </div>
            @else
                <p class="text-gray-400 text-sm">لا توجد مباريات أخرى</p>
            @endif
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const video = document.getElementById('videoPlayer');
        const streamUrl = '{{ $game->channel->stream_url }}';

        // Check if the URL is an HLS stream (M3U8)
        if (streamUrl.includes('.m3u8')) {
            if (Hls.isSupported()) {
                const hls = new Hls();
                hls.loadSource(streamUrl);
                hls.attachMedia(video);
                hls.on(Hls.Events.MANIFEST_PARSED, function() {
                    video.play();
                });
            } else if (video.canPlayType('application/vnd.apple.mpegurl')) {
                // Safari native support
                video.src = streamUrl;
                video.addEventListener('loadedmetadata', function() {
                    video.play();
                });
            }
        }
    });
</script>
@endsection
