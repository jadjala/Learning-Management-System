@extends('layouts.app')

@section('title', $course->title)

@section('content')
<div class="max-w-4xl mx-auto">
    {{-- Course Header with Thumbnail --}}
    <div class="bg-white dark:bg-gray-800 rounded-lg shadow-lg overflow-hidden mb-8">
        @if($course->thumbnail)
            <img src="{{ asset('storage/' . $course->thumbnail) }}" 
                 alt="{{ $course->title }}" 
                 class="w-full h-64 object-cover">
        @else
            <div class="w-full h-64 bg-gray-200 dark:bg-gray-700 flex items-center justify-center">
                <span class="text-gray-400 text-6xl">📚</span>
            </div>
        @endif

        <div class="p-8">
            <h1 class="text-4xl font-bold mb-4">{{ $course->title }}</h1>
            <p class="text-gray-600 dark:text-gray-400 mb-4">{{ $course->short_description }}</p>
            
            <div class="flex items-center space-x-4 mb-6">
                <span class="text-sm text-gray-500">
                    👨‍🏫 Instructor: <strong>{{ $course->instructor->name }}</strong>
                </span>
                <span class="text-sm text-gray-500">
                    📚 {{ $course->lessons->count() }} lessons
                </span>
                <span class="text-sm text-gray-500">
                    👥 {{ $course->enrollments->count() }} students
                </span>
            </div>

            @auth
                @if(Auth::user()->isStudent())
                    <div class="flex space-x-4">
                        {{-- Enroll/Unenroll Button --}}
                        @if($isEnrolled)
                            <form action="{{ route('enrollments.destroy', $course->id) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="bg-red-500 hover:bg-red-600 text-white px-6 py-2 rounded-md font-medium">
                                    Unenroll from Course
                                </button>
                            </form>
                        @else
                            <form action="{{ route('enrollments.store') }}" method="POST">
                                @csrf
                                <input type="hidden" name="course_id" value="{{ $course->id }}">
                                <button type="submit" class="bg-primary hover:bg-blue-600 text-white px-6 py-2 rounded-md font-medium">
                                    Enroll in Course
                                </button>
                            </form>
                        @endif

                        {{-- Bookmark Button --}}
                        @if($isBookmarked)
                            <form action="{{ route('bookmarks.destroy', $course->id) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="bg-yellow-500 hover:bg-yellow-600 text-white px-6 py-2 rounded-md font-medium flex items-center">
                                    <span class="mr-2">⭐</span>
                                    Remove Bookmark
                                </button>
                            </form>
                        @else
                            <form action="{{ route('bookmarks.store') }}" method="POST">
                                @csrf
                                <input type="hidden" name="course_id" value="{{ $course->id }}">
                                <button type="submit" class="bg-gray-500 hover:bg-gray-600 text-white px-6 py-2 rounded-md font-medium flex items-center">
                                    <span class="mr-2">☆</span>
                                    Bookmark Course
                                </button>
                            </form>
                        @endif
                    </div>
                @endif
            @else
                <p class="text-gray-500">
                    <a href="{{ route('login') }}" class="text-primary hover:underline">Login</a> or 
                    <a href="{{ route('register') }}" class="text-primary hover:underline">Register</a> to enroll in this course
                </p>
            @endauth
        </div>
    </div>

    {{-- Course Description --}}
    <div class="bg-white dark:bg-gray-800 rounded-lg shadow-lg p-8 mb-8">
        <h2 class="text-2xl font-bold mb-4">About This Course</h2>
        <div class="prose dark:prose-invert max-w-none">
            {!! nl2br(e($course->content)) !!}
        </div>
    </div>

    {{-- Lessons List --}}
    <div class="bg-white dark:bg-gray-800 rounded-lg shadow-lg p-8">
        <h2 class="text-2xl font-bold mb-6">Course Lessons</h2>
        
        @if($course->lessons->isEmpty())
            <p class="text-gray-500">No lessons available yet.</p>
        @else
            <div class="space-y-4">
                @foreach($course->lessons as $index => $lesson)
                    <div class="border border-gray-200 dark:border-gray-700 rounded-lg p-4 hover:bg-gray-50 dark:hover:bg-gray-700 transition">
                        <div class="flex justify-between items-start">
                            <div class="flex-1">
                                <h3 class="text-lg font-semibold mb-2">
                                    <span class="text-gray-400 mr-2">{{ $index + 1 }}.</span>
                                    {{ $lesson->title }}
                                </h3>
                                <p class="text-gray-600 dark:text-gray-400 text-sm">
                                    {{ Str::limit($lesson->content, 150) }}
                                </p>
                            </div>
                            
                            @if($isEnrolled)
                                <a href="#" class="ml-4 text-primary hover:underline text-sm whitespace-nowrap">
                                    View Lesson →
                                </a>
                            @endif
                        </div>
                    </div>
                @endforeach
            </div>
        @endif
    </div>
</div>
@endsection