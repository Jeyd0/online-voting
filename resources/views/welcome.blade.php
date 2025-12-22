<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ config('app.name', 'Online Voting') }}</title>
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ mix('css/app.css') }}">
    <script src="{{ mix('js/app.js') }}" defer></script>
</head>
<body class="antialiased bg-gray-100 dark:bg-gray-900" x-data="{ darkMode: localStorage.getItem('darkMode') === 'true' }" x-init="$watch('darkMode', val => val ? document.documentElement.classList.add('dark') : document.documentElement.classList.remove('dark')); if(darkMode) document.documentElement.classList.add('dark');">
    <div class="relative flex items-top justify-center min-h-screen sm:items-center py-4 sm:pt-0">
        @if (Route::has('login'))
            <div class="fixed top-0 right-0 px-6 py-4">
                @auth
                    @if(Auth::user()->role === 'admin')
                        <a href="{{ route('admin.dashboard') }}" class="text-sm text-gray-700 dark:text-gray-500 underline">Admin Dashboard</a>
                    @else
                        <a href="{{ route('vote') }}" class="text-sm text-gray-700 dark:text-gray-500 underline">Vote Now</a>
                    @endif
                @else
                    <a href="{{ route('login') }}" class="text-sm text-gray-700 dark:text-gray-500 underline">Log in</a>
                    @if (Route::has('register'))
                        <a href="{{ route('register') }}" class="ml-4 text-sm text-gray-700 dark:text-gray-500 underline">Register</a>
                    @endif
                @endauth
            </div>
        @endif

        <div class="max-w-6xl mx-auto sm:px-6 lg:px-8 text-center">
            <div class="flex justify-center pt-8 sm:justify-start sm:pt-0 mb-8">
                <h1 class="text-5xl font-bold text-gray-800 dark:text-white">Online Voting System</h1>
            </div>

            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow sm:rounded-lg p-6">
                <p class="text-lg text-gray-600 dark:text-gray-300 mb-6">
                    Welcome to the secure online voting platform. Please login to cast your vote or manage the election.
                </p>
                
                <div class="flex justify-center space-x-4">
                    @auth
                        @if(Auth::user()->role === 'admin')
                            <a href="{{ route('admin.dashboard') }}" class="px-6 py-3 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition">Go to Admin Dashboard</a>
                        @else
                            <a href="{{ route('vote') }}" class="px-6 py-3 bg-green-600 text-white rounded-lg hover:bg-green-700 transition">Cast Your Vote</a>
                        @endif
                    @else
                        <a href="{{ route('login') }}" class="px-6 py-3 bg-indigo-600 text-white rounded-lg hover:bg-indigo-700 transition">Login to Vote</a>
                        <a href="{{ route('register') }}" class="px-6 py-3 bg-gray-600 text-white rounded-lg hover:bg-gray-700 transition">Register Voter</a>
                    @endauth
                </div>
            </div>
            
            <div class="mt-8 text-gray-500 dark:text-gray-400 text-sm">
                Secure • Transparent • Easy
            </div>
        </div>
    </div>
</body>
</html>
