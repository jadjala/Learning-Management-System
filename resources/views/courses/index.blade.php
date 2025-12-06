@extends('layouts.app')

@section('title', 'All Courses')

@section('content')
<div class="mb-8">
    <h1 class="text-4xl font-bold mb-2">All Courses</h1>
    <p class="text-gray-600 dark:text-gray-400">Browse our collection of courses and start learning today</p>
</div>

@if($courses->isEmpty())
    <div class="bg-white dark:bg-gray-800 rounded-lg shadow p-12 text-center">
        <p class="text-gray-500 dark:text-gray-400 text-lg">No courses available yet. Check back soon!</p>
    </div>
@else
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        @foreach($courses as $course)
            <div class="bg-white dark:bg-gray-800 rounded-lg shadow-lg hover:shadow-xl transition-shadow duration-200 overflow-hidden">
                <img src="{{ $course->thumbnail_url }}" alt="{{ $course->title }}" class="w-full h-48 object-cover">
                <div class="p-6">
                    <h2 class="text-xl font-bold mb-2">
                        <a href="{{ route('courses.show', $course) }}" class="hover:text-primary">
                            {{ $course->title }}
                        </a>
                    </h2>
                    <p class="text-sm text-gray-600 dark:text-gray-400 mb-2">
                        By {{ $course->instructor->name }}
                    </p>
                    <p class="text-xs text-gray-500 dark:text-gray-500 mb-3">
                        Created {{ $course->created_at->format('M d, Y') }}
                    </p>
                    <p class="text-gray-700 dark:text-gray-300 mb-4">
                        {{ Str::limit($course->short_description, 120) }}
                    </p>
                    <a href="{{ route('courses.show', $course) }}" 
                       class="inline-block bg-primary hover:bg-blue-600 text-white px-4 py-2 rounded-md text-sm font-medium">
                        View Course
                    </a>
                </div>
            </div>
        @endforeach
    </div>

    <div class="mt-8">
        {{ $courses->links() }}
    </div>
@endif
@endsection