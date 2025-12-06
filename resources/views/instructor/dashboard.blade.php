@extends('layouts.app')

@section('title', 'Instructor Dashboard')

@section('content')
<div class="mb-8 flex justify-between items-center">
    <div>
        <h1 class="text-4xl font-bold mb-2">Instructor Dashboard</h1>
        <p class="text-gray-600 dark:text-gray-400">Manage your courses and lessons</p>
    </div>
    <a href="{{ route('instructor.courses.create') }}" 
       class="bg-primary hover:bg-blue-600 text-white px-6 py-3 rounded-md font-medium">
        Create New Course
    </a>
</div>

@if($courses->isEmpty())
    <div class="bg-white dark:bg-gray-800 rounded-lg shadow p-12 text-center">
        <p class="text-gray-500 dark:text-gray-400 text-lg mb-4">You haven't created any courses yet.</p>
        <a href="{{ route('instructor.courses.create') }}" 
           class="inline-block bg-primary hover:bg-blue-600 text-white px-6 py-3 rounded-md font-medium">
            Create Your First Course
        </a>
    </div>
@else
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        @foreach($courses as $course)
            <div class="bg-white dark:bg-gray-800 rounded-lg shadow-lg overflow-hidden">
                {{-- Thumbnail Image --}}
                @if($course->thumbnail)
                    <img src="{{ asset('storage/' . $course->thumbnail) }}" 
                         alt="{{ $course->title }}" 
                         class="w-full h-48 object-cover">
                @else
                    <div class="w-full h-48 bg-gray-200 dark:bg-gray-700 flex items-center justify-center">
                        <span class="text-gray-400 text-4xl">📚</span>
                    </div>
                @endif

                <div class="p-6">
                    <h2 class="text-2xl font-bold mb-2">{{ $course->title }}</h2>
                    <p class="text-gray-600 dark:text-gray-400 mb-4 line-clamp-2">{{ $course->short_description }}</p>
                    
                    <div class="flex space-x-4 text-sm text-gray-500 dark:text-gray-400 mb-4">
                        <span>📚 {{ $course->lessons_count }} lessons</span>
                        <span>👥 {{ $course->enrollments_count }} students</span>
                    </div>

                    <div class="flex flex-wrap gap-2">
                        <a href="{{ route('courses.show', $course->id) }}" 
                           class="bg-gray-500 hover:bg-gray-600 text-white px-4 py-2 rounded-md text-sm font-medium">
                            View
                        </a>
                        <a href="{{ route('instructor.courses.edit', $course->id) }}" 
                           class="bg-yellow-500 hover:bg-yellow-600 text-white px-4 py-2 rounded-md text-sm font-medium">
                            Edit
                        </a>
                        <a href="{{ route('instructor.lessons.create', $course->id) }}" 
                           class="bg-green-500 hover:bg-green-600 text-white px-4 py-2 rounded-md text-sm font-medium">
                            Add Lesson
                        </a>
                        <form action="{{ route('instructor.courses.destroy', $course->id) }}" method="POST" class="inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" 
                                    class="bg-red-500 hover:bg-red-600 text-white px-4 py-2 rounded-md text-sm font-medium"
                                    onclick="return confirm('Are you sure? This will delete all lessons too.')">
                                Delete
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
@endif
@endsection