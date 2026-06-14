<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title') - Sports Live Stream</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        body { font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; }
        .video-player { background: #000; aspect-ratio: 16 / 9; }
    </style>
</head>
<body class="bg-gray-900 text-gray-100">
    <!-- Navigation -->
    <nav class="bg-gray-800 border-b border-gray-700">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center h-16">
                <div class="flex items-center space-x-8 rtl:space-x-reverse">
                    <a href="{{ route('home') }}" class="text-2xl font-bold text-red-500">
                        <i class="fas fa-play-circle"></i> Sports Live
                    </a>
                    <div class="hidden md:flex space-x-4 rtl:space-x-reverse">
                        <a href="{{ route('games.live') }}" class="hover:text-red-500 transition">المباريات المباشرة</a>
                        <a href="{{ route('games.upcoming') }}" class="hover:text-red-500 transition">المباريات القادمة</a>
                        <a href="{{ route('channels.index') }}" class="hover:text-red-500 transition">القنوات</a>
                        <a href="{{ route('teams.index') }}" class="hover:text-red-500 transition">الفرق</a>
                    </div>
                </div>
            </div>
        </div>
    </nav>

    <!-- Flash Messages -->
    @if ($message = Session::get('success'))
        <div class="bg-green-500 text-white p-4 m-4 rounded">
            {{ $message }}
        </div>
    @endif

    <!-- Main Content -->
    <main class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        @yield('content')
    </main>

    <!-- Footer -->
    <footer class="bg-gray-800 border-t border-gray-700 mt-12 py-8">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center text-gray-400">
            <p>&copy; 2026 Sports Live Stream. جميع الحقوق محفوظة.</p>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/hls.js@latest"></script>
    @yield('scripts')
</body>
</html>
