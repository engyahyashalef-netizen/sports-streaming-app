@extends('layouts.app')

@section('title', 'تعديل القناة')

@section('content')
<div class="max-w-2xl mx-auto">
    <h1 class="text-3xl font-bold mb-6">تعديل القناة</h1>

    <form action="{{ route('channels.update', $channel) }}" method="POST" class="bg-gray-800 rounded-lg p-6 border border-gray-700">
        @csrf
        @method('PUT')

        <div class="mb-6">
            <label class="block text-sm font-bold mb-2">اسم القناة</label>
            <input type="text" name="name" value="{{ $channel->name }}" class="w-full bg-gray-700 border border-gray-600 rounded px-4 py-2 text-white" required>
            @error('name')<p class="text-red-500 text-sm mt-1">{{ $message }}</p>@enderror
        </div>

        <div class="mb-6">
            <label class="block text-sm font-bold mb-2">رابط البث (Stream URL)</label>
            <input type="url" name="stream_url" value="{{ $channel->stream_url }}" class="w-full bg-gray-700 border border-gray-600 rounded px-4 py-2 text-white" required>
            @error('stream_url')<p class="text-red-500 text-sm mt-1">{{ $message }}</p>@enderror
        </div>

        <div class="mb-6">
            <label class="block text-sm font-bold mb-2">شعار القناة (URL)</label>
            <input type="url" name="logo" value="{{ $channel->logo }}" class="w-full bg-gray-700 border border-gray-600 rounded px-4 py-2 text-white">
            @error('logo')<p class="text-red-500 text-sm mt-1">{{ $message }}</p>@enderror
        </div>

        <div class="mb-6">
            <label class="block text-sm font-bold mb-2">الوصف</label>
            <textarea name="description" class="w-full bg-gray-700 border border-gray-600 rounded px-4 py-2 text-white" rows="4">{{ $channel->description }}</textarea>
            @error('description')<p class="text-red-500 text-sm mt-1">{{ $message }}</p>@enderror
        </div>

        <div class="mb-6">
            <label class="flex items-center">
                <input type="checkbox" name="is_active" value="1" {{ $channel->is_active ? 'checked' : '' }} class="mr-2">
                <span class="text-sm font-bold">تفعيل القناة</span>
            </label>
        </div>

        <div class="flex gap-4">
            <button type="submit" class="bg-green-500 hover:bg-green-600 text-white px-6 py-2 rounded-lg transition">
                <i class="fas fa-save"></i> حفظ التغييرات
            </button>
            <a href="{{ route('channels.index') }}" class="bg-gray-700 hover:bg-gray-600 text-white px-6 py-2 rounded-lg transition">
                <i class="fas fa-times"></i> إلغاء
            </a>
        </div>
    </form>
</div>
@endsection
