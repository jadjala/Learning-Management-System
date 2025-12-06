<!DOCTYPE html>
<html lang="en">
<head>
    <script>
        // Apply dark mode IMMEDIATELY before page renders to prevent flash
        if (localStorage.getItem('dark_mode') === 'true') {
            document.documentElement.classList.add('dark');
        }
    </script>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Simple LMS')</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            darkMode: 'class',
            theme: {
                extend: {
                    colors: {
                        primary: '#3b82f6',
                        secondary: '#8b5cf6',
                    }
                }
            }
        }
    </script>
</head>
<body class="bg-gray-50 dark:bg-gray-900 text-gray-900 dark:text-gray-100 min-h-screen transition-colors duration-200">
    <nav class="bg-white dark:bg-gray-800 shadow-lg border-b border-gray-200 dark:border-gray-700">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-16">
                <div class="flex items-center">
                    <a href="/" class="text-2xl font-bold text-primary">Simple LMS</a>
                    <div class="ml-10 flex space-x-4">
                        <a href="{{ route('courses.index') }}" class="text-gray-700 dark:text-gray-300 hover:text-primary px-3 py-2 rounded-md text-sm font-medium">Courses</a>
                        @auth
                            @if(Auth::user()->isStudent())
                                <a href="{{ route('bookmarks.index') }}" class="text-gray-700 dark:text-gray-300 hover:text-primary px-3 py-2 rounded-md text-sm font-medium">Bookmarks</a>
                            @endif
                        @endauth
                    </div>
                </div>
                
                <div class="flex items-center space-x-4">
                    <button onclick="toggleDarkMode()" class="p-2 rounded-md hover:bg-gray-100 dark:hover:bg-gray-700">
                        <span class="dark:hidden">🌙</span>
                        <span class="hidden dark:inline">☀️</span>
                    </button>
                    
                    @auth
                        <a href="{{ Auth::user()->isInstructor() ? route('instructor.dashboard') : route('student.dashboard') }}" 
                           class="text-gray-700 dark:text-gray-300 hover:text-primary px-3 py-2 rounded-md text-sm font-medium">
                            Dashboard
                        </a>
                        <span class="text-gray-600 dark:text-gray-400">{{ Auth::user()->name }}</span>
                        <form action="{{ route('logout') }}" method="POST" class="inline">
                            @csrf
                            <button type="submit" class="bg-red-500 hover:bg-red-600 text-white px-4 py-2 rounded-md text-sm font-medium">
                                Logout
                            </button>
                        </form>
                    @else
                        <a href="{{ route('login') }}" class="text-gray-700 dark:text-gray-300 hover:text-primary px-3 py-2 rounded-md text-sm font-medium">Login</a>
                        <a href="{{ route('register') }}" class="bg-primary hover:bg-blue-600 text-white px-4 py-2 rounded-md text-sm font-medium">Register</a>
                    @endauth
                </div>
            </div>
        </div>
    </nav>

    <main class="py-8">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            @if(session('success'))
                <x-alert type="success" :message="session('success')" />
            @endif

            @if(session('error'))
                <x-alert type="error" :message="session('error')" />
            @endif

            @if(session('info'))
                <x-alert type="info" :message="session('info')" />
            @endif

            @yield('content')
        </div>
    </main>

    <footer class="bg-white dark:bg-gray-800 border-t border-gray-200 dark:border-gray-700 mt-auto">
        <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
            <p class="text-center text-gray-500 dark:text-gray-400 text-sm">
                &copy; {{ date('Y') }} Simple LMS. All rights reserved.
            </p>
        </div>
    </footer>

    <div id="toast" class="hidden fixed bottom-4 right-4 bg-purple-500 text-white px-6 py-4 rounded-lg shadow-lg"></div>

    <script>
        function toggleDarkMode() {
            document.documentElement.classList.toggle('dark');
            const isDark = document.documentElement.classList.contains('dark');
            localStorage.setItem('dark_mode', isDark);
        }

        // Easter egg: 5th visit toast
        let visits = parseInt(localStorage.getItem('lms_visits') || '0') + 1;
        localStorage.setItem('lms_visits', visits);
        
        if (visits === 5) {
            const toast = document.getElementById('toast');
            toast.textContent = '🎉 Congrats! You found the hidden toast';
            toast.classList.remove('hidden');
            setTimeout(() => toast.classList.add('hidden'), 5000);
        }
    </script>
</body>
</html>