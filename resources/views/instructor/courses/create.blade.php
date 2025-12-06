@extends('layouts.app')

@section('title', 'Create Course')

@section('content')
<div class="max-w-3xl mx-auto">
    <h1 class="text-4xl font-bold mb-8">Create New Course</h1>

    <div class="bg-white dark:bg-gray-800 rounded-lg shadow-lg p-8">
        <form action="{{ route('instructor.courses.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <div class="mb-6">
                <label for="title" class="block text-sm font-medium mb-2">Course Title</label>
                <input type="text" name="title" id="title" value="{{ old('title') }}" required
                       class="w-full px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-md focus:ring-2 focus:ring-primary dark:bg-gray-700">
                @error('title')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-6">
                <label for="thumbnail" class="block text-sm font-medium mb-2">Course Thumbnail (Optional)</label>
                <input type="file" name="thumbnail" id="thumbnail" accept="image/*"
                       class="w-full px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-md focus:ring-2 focus:ring-primary dark:bg-gray-700">
                <p class="text-sm text-gray-500 mt-1">Image file, max 2MB</p>
                @error('thumbnail')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-6">
                <label for="short_description" class="block text-sm font-medium mb-2">Short Description</label>
                <textarea name="short_description" id="short_description" rows="3" required
                          class="w-full px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-md focus:ring-2 focus:ring-primary dark:bg-gray-700">{{ old('short_description') }}</textarea>
                @error('short_description')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-6">
                <label for="content" class="block text-sm font-medium mb-2">Full Description</label>
                <textarea name="content" id="content" rows="6" required
                          class="w-full px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-md focus:ring-2 focus:ring-primary dark:bg-gray-700">{{ old('content') }}</textarea>
                @error('content')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="flex space-x-4">
                <button type="submit" class="bg-primary hover:bg-blue-600 text-white px-6 py-2 rounded-md font-medium">
                    Create Course
                </button>
                <a href="{{ route('instructor.dashboard') }}" 
                   class="bg-gray-500 hover:bg-gray-600 text-white px-6 py-2 rounded-md font-medium">
                    Cancel
                </a>
            </div>
        </form>
    </div>
</div>
@endsection