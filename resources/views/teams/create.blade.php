@extends('layouts.app')

@section('title', 'إضافة فريق جديد')

@section('content')
<div class="max-w-2xl mx-auto">
    <h1 class="text-3xl font-bold mb-6">إضافة فريق جديد</h1>

    <form action="{{ route('teams.store') }}" method="POST" class="bg-gray-800 rounded-lg p-6 border border-gray-700">
        @csrf

        <div class="mb-6">
            <label class="block text-sm font-bold mb-2">اسم الفريق</label>
            <input type="text" name="name" class="w-full bg-gray-700 border border-gray-600 rounded px-4 py-2 text-white" required>
            @error('name')<p class="text-red-500 text-sm mt-1">{{ $message }}</p>@enderror
        </div>

        <div class="mb-6">
            <label class="block text-sm font-bold mb-2">شعار الفريق (URL)</label>
            <input type="url" name="logo" class="w-full bg-gray-700 border border-gray-600 rounded px-4 py-2 text-white" placeholder="https://example.com/logo.png">
            @error('logo')<p class="text-red-500 text-sm mt-1">{{ $message }}</p>@enderror
        </div>

        <div class="mb-6">
            <label class="block text-sm font-bold mb-2">الوصف</label>
            <textarea name="description" class="w-full bg-gray-700 border border-gray-600 rounded px-4 py-2 text-white" rows="4"></textarea>
            @error('description')<p class="text-red-500 text-sm mt-1">{{ $message }}</p>@enderror
        </div>

        <div class="flex gap-4">
            <button type="submit" class="bg-yellow-500 hover:bg-yellow-600 text-white px-6 py-2 rounded-lg transition">
                <i class="fas fa-save"></i> حفظ
            </button>
            <a href="{{ route('teams.index') }}" class="bg-gray-700 hover:bg-gray-600 text-white px-6 py-2 rounded-lg transition">
                <i class="fas fa-times"></i> إلغاء
            </a>
        </div>
    </form>
</div>
@endsection
