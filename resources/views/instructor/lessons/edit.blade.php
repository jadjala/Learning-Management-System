@extends('layouts.app')

@section('title', 'Edit Lesson')

@section('content')
<div class="max-w-3xl mx-auto">
    <h1 class="text-4xl font-bold mb-2">Edit Lesson</h1>
    <p class="text-gray-600 dark:text-gray-400 mb-8">Course: {{ $course->title }}</p>

    <div class="bg-white dark:bg-gray-800 rounded-lg shadow-lg p-8">
        <form action="{{ route('instructor.lessons.update', [$course, $lesson]) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="mb-6">
                <label for="title" class="block text-sm font-medium mb-2">Lesson Title</label>
                <input type="text" name="title" id="title" value="{{ old('title', $lesson->title) }}" required
                       class="w-full px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-md focus:ring-2 focus:ring-primary dark:bg-gray-700">
                @error('title')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-6">
                <label for="content" class="block text-sm font-medium mb-2">Lesson Content</label>
                <textarea name="content" id="content" rows="10" required
                          class="w-full px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-md focus:ring-2 focus:ring-primary dark:bg-gray-700">{{ old('content', $lesson->content) }}</textarea>
                @error('content')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="flex space-x-4">
                <button type="submit" class="bg-primary hover:bg-blue-600 text-white px-6 py-2 rounded-md font-medium">
                    Update Lesson
                </button>
                <a href="{{ route('courses.show', $course) }}" 
                   class="bg-gray-500 hover:bg-gray-600 text-white px-6 py-2 rounded-md font-medium">
                    Cancel
                </a>
            </div>
        </form>
    </div>
</div>
@endsection