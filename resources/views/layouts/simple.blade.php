<!DOCTYPE html>
<html lang="en" class="{{ session('dark_mode', false) ? 'dark' : '' }}">
<head>
    <title>Simple LMS</title>
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
<body class="bg-gray-50 dark:bg-gray-900 text-gray-900 dark:text-gray-100">
    <nav class="bg-white dark:bg-gray-800 shadow-lg">
        <div class="max-w-7xl mx-auto px-4">
            <div class="flex justify-between h-16">
                <div class="flex items-center">
                    <a href="/" class="text-2xl font-bold text-primary">Simple LMS</a>
                    <div class="ml-10 flex space-x-4">
                        <a href="{{ route('courses.index') }}">Courses</a>
                        @auth
                            @if(Auth::user()->isStudent())
                                <a href="{{ route('bookmarks.index') }}">Bookmarks</a>
                            @endif
                        @endauth
                    </div>
                </div>
                
                <div class="flex items-center space-x-4">
                    @auth
                        <a href="{{ Auth::user()->isInstructor() ? route('instructor.dashboard') : route('student.dashboard') }}">
                            Dashboard
                        </a>
                        <span>{{ Auth::user()->name }}</span>
                        <form action="{{ route('logout') }}" method="POST" class="inline">
                            @csrf
                            <button type="submit">Logout</button>
                        </form>
                    @else
                        <a href="{{ route('login') }}">Login</a>
                        <a href="{{ route('register') }}">Register</a>
                    @endauth
                </div>
            </div>
        </div>
    </nav>

    <main class="py-8">
        <div class="max-w-7xl mx-auto px-4">
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
</body>
</html>