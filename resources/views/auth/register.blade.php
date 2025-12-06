@extends('layouts.app')

@section('title', 'Register - Simple LMS')

@section('content')
<div class="max-w-md mx-auto">
    <div class="bg-white dark:bg-gray-800 shadow-lg rounded-lg p-8">
        <h2 class="text-3xl font-bold mb-6 text-center">Register</h2>
        
        <form action="{{ route('register') }}" method="POST">
            @csrf
            
            <div class="mb-4">
                <label for="name" class="block text-sm font-medium mb-2">Full Name</label>
                <input type="text" name="name" id="name" value="{{ old('name') }}" required
                       class="w-full px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-md focus:ring-2 focus:ring-primary dark:bg-gray-700">
                @error('name')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

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
                <label for="password_confirmation" class="block text-sm font-medium mb-2">Confirm Password</label>
                <input type="password" name="password_confirmation" id="password_confirmation" required
                       class="w-full px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-md focus:ring-2 focus:ring-primary dark:bg-gray-700">
            </div>

            <div class="mb-6">
                <label class="block text-sm font-medium mb-2">Register as</label>
                <div class="space-y-2">
                    <label class="flex items-center">
                        <input type="radio" name="role" value="student" checked class="text-primary focus:ring-primary">
                        <span class="ml-2">Student</span>
                    </label>
                    <label class="flex items-center">
                        <input type="radio" name="role" value="instructor" class="text-primary focus:ring-primary">
                        <span class="ml-2">Instructor</span>
                    </label>
                </div>
                @error('role')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <button type="submit" class="w-full bg-primary hover:bg-blue-600 text-white font-medium py-2 px-4 rounded-md">
                Register
            </button>
        </form>

        <p class="mt-4 text-center text-sm">
            Already have an account? 
            <a href="{{ route('login') }}" class="text-primary hover:underline">Login here</a>
        </p>
    </div>
</div>
@endsection