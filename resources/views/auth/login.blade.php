@extends('layouts.app')

@section('title', 'Login - Simple LMS')

@section('content')
<div class="max-w-md mx-auto">
    <div class="bg-white dark:bg-gray-800 shadow-lg rounded-lg p-8">
        <h2 class="text-3xl font-bold mb-6 text-center">Login</h2>
        
        <form action="{{ route('login') }}" method="POST">
            @csrf
            
            <div class="mb-4">
                <label for="email" class="block text-sm font-medium mb-2">Email</label>
                <input type="email" name="email" id="email" value="{{ old('email') }}" required
                       class="w-full px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-md focus:ring-2 focus:ring-primary dark:bg-gray-700">
                @error('email')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-4">
                <label for="password" class="block text-sm font-medium mb-2">Password</label>
                <input type="password" name="password" id="password" required
                       class="w-full px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-md focus:ring-2 focus:ring-primary dark:bg-gray-700">
                @error('password')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-4">
                <label class="flex items-center">
                    <input type="checkbox" name="remember" class="rounded border-gray-300 text-primary focus:ring-primary">
                    <span class="ml-2 text-sm">Remember me</span>
                </label>
            </div>

            <button type="submit" class="w-full bg-primary hover:bg-blue-600 text-white font-medium py-2 px-4 rounded-md">
                Login
            </button>
        </form>

        <p class="mt-4 text-center text-sm">
            Don't have an account? 
            <a href="{{ route('register') }}" class="text-primary hover:underline">Register here</a>
        </p>
    </div>
</div>
@endsection