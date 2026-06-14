@extends('layouts.app')

@section('title', 'جميع المباريات')

@section('content')
<div class="flex justify-between items-center mb-6">
    <h1 class="text-3xl font-bold">جميع المباريات</h1>
    <a href="{{ route('games.create') }}" class="bg-red-500 hover:bg-red-600 text-white px-6 py-2 rounded-lg transition">
        <i class="fas fa-plus"></i> إضافة مباراة جديدة
    </a>
</div>

<div class="bg-gray-800 rounded-lg border border-gray-700 overflow-hidden">
    <table class="w-full">
        <thead class="bg-gray-700">
            <tr>
                <th class="px-6 py-3 text-right">الفريق الأول</th>
                <th class="px-6 py-3 text-right">الفريق الثاني</th>
                <th class="px-6 py-3 text-right">القناة</th>
                <th class="px-6 py-3 text-right">الوقت</th>
                <th class="px-6 py-3 text-right">الحالة</th>
                <th class="px-6 py-3 text-right">الإجراءات</th>
            </tr>
        </thead>
        <tbody class="divide-y divide-gray-700">
            @forelse($games as $game)
                <tr class="hover:bg-gray-700 transition">
                    <td class="px-6 py-4">{{ $game->teamA->name }}</td>
                    <td class="px-6 py-4">{{ $game->teamB->name }}</td>
                    <td class="px-6 py-4">{{ $game->channel->name }}</td>
                    <td class="px-6 py-4">{{ $game->start_time->format('d M Y H:i') }}</td>
                    <td class="px-6 py-4">
                        @if($game->status === 'live')
                            <span class="bg-red-500 text-white px-3 py-1 rounded text-sm">مباشر</span>
                        @elseif($game->status === 'upcoming')
                            <span class="bg-blue-500 text-white px-3 py-1 rounded text-sm">قادمة</span>
                        @else
                            <span class="bg-gray-500 text-white px-3 py-1 rounded text-sm">انتهت</span>
                        @endif
                    </td>
                    <td class="px-6 py-4">
                        <a href="{{ route('watch', $game) }}" class="text-blue-400 hover:text-blue-300 mr-3">
                            <i class="fas fa-play"></i>
                        </a>
                        <a href="{{ route('games.edit', $game) }}" class="text-yellow-400 hover:text-yellow-300 mr-3">
                            <i class="fas fa-edit"></i>
                        </a>
                        <form action="{{ route('games.destroy', $game) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="text-red-400 hover:text-red-300" onclick="return confirm('هل أنت متأكد؟')">
                                <i class="fas fa-trash"></i>
                            </button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="6" class="px-6 py-8 text-center text-gray-400">
                        <i class="fas fa-inbox text-3xl mb-2"></i>
                        <p>لا توجد مباريات</p>
                    </td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>

<div class="mt-6">
    {{ $games->links() }}
</div>
@endsection
