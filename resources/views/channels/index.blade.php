@extends('layouts.app')

@section('title', 'القنوات')

@section('content')
<div class="flex justify-between items-center mb-6">
    <h1 class="text-3xl font-bold">القنوات</h1>
    <a href="{{ route('channels.create') }}" class="bg-green-500 hover:bg-green-600 text-white px-6 py-2 rounded-lg transition">
        <i class="fas fa-plus"></i> إضافة قناة جديدة
    </a>
</div>

<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
    @forelse($channels as $channel)
        <div class="bg-gray-800 rounded-lg overflow-hidden border border-gray-700 hover:border-green-500 transition">
            @if($channel->logo)
                <img src="{{ $channel->logo }}" alt="{{ $channel->name }}" class="w-full h-40 object-cover">
            @else
                <div class="w-full h-40 bg-gray-700 flex items-center justify-center">
                    <i class="fas fa-tv text-4xl text-gray-600"></i>
                </div>
            @endif
            <div class="p-4">
                <div class="flex justify-between items-start mb-2">
                    <h3 class="text-lg font-bold">{{ $channel->name }}</h3>
                    @if($channel->is_active)
                        <span class="bg-green-500 text-white px-2 py-1 rounded text-xs">نشط</span>
                    @else
                        <span class="bg-gray-500 text-white px-2 py-1 rounded text-xs">معطل</span>
                    @endif
                </div>
                @if($channel->description)
                    <p class="text-sm text-gray-400 mb-4">{{ Str::limit($channel->description, 100) }}</p>
                @endif
                <div class="flex gap-2">
                    <a href="{{ route('channels.edit', $channel) }}" class="flex-1 bg-yellow-500 hover:bg-yellow-600 text-white px-3 py-2 rounded text-center text-sm transition">
                        <i class="fas fa-edit"></i> تعديل
                    </a>
                    <form action="{{ route('channels.destroy', $channel) }}" method="POST" style="flex: 1;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="w-full bg-red-500 hover:bg-red-600 text-white px-3 py-2 rounded text-sm transition" onclick="return confirm('هل أنت متأكد؟')">
                            <i class="fas fa-trash"></i> حذف
                        </button>
                    </form>
                </div>
            </div>
        </div>
    @empty
        <div class="col-span-full bg-gray-800 rounded-lg p-12 text-center border border-gray-700">
            <i class="fas fa-inbox text-6xl text-gray-600 mb-4"></i>
            <p class="text-gray-400 text-lg">لا توجد قنوات</p>
        </div>
    @endforelse
</div>

<div class="mt-6">
    {{ $channels->links() }}
</div>
@endsection
