@extends('layouts.app')

@section('title', $course->title)

@section('content')
<div class="bg-white dark:bg-gray-800 rounded-lg shadow-lg p-8 mb-6">
    <div class="flex justify-between items-start mb-4">
        <div class="flex-1">
            <h1 class="text-4xl font-bold mb-2">{{ $course->title }}</h1>
            <p class="text-gray-600 dark:text-gray-400">
                Instructor: <span class="font-medium">{{ $course->instructor->name }}</span>
            </p>
        </div>

        @auth
            @if(Auth::user()->isStudent())
                @if($isEnrolled)
                    <form action="{{ route('student.courses.unenroll', $course) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="bg-red-500 hover:bg-red-600 text-white px-6 py-2 rounded-md font-medium">
                            Unenroll
                        </button>
                    </form>
                @else
                    <form action="{{ route('student.courses.enroll', $course) }}" method="POST">
                        @csrf
                        <button type="submit" class="bg-green-500 hover:bg-green-600 text-white px-6 py-2 rounded-md font-medium">
                            Enroll Now
                        </button>
                    </form>
                @endif
            @elseif(Auth::user()->id === $course->user_id)
                <div class="flex space-x-2">
                    <a href="{{ route('instructor.courses.edit', $course) }}" 
                       class="bg-yellow-500 hover:bg-yellow-600 text-white px-4 py-2 rounded-md font-medium">
                        Edit Course
                    </a>
                    <a href="{{ route('instructor.lessons.create', $course) }}" 
                       class="bg-green-500 hover:bg-green-600 text-white px-4 py-2 rounded-md font-medium">
                        Add Lesson
                    </a>
                </div>
            @endif
        @endauth
    </div>

    <div class="prose dark:prose-invert max-w-none">
        <h3 class="text-xl font-semibold mb-2">About this course</h3>
        <p class="text-gray-700 dark:text-gray-300">{{ $course->short_description }}</p>
        
        <div class="mt-4">
            <h3 class="text-xl font-semibold mb-2">Course Description</h3>
            <p class="text-gray-700 dark:text-gray-300">{{ $course->content }}</p>
        </div>
    </div>
</div>

<div class="bg-white dark:bg-gray-800 rounded-lg shadow-lg p-8">
    <h2 class="text-2xl font-bold mb-6">Course Lessons ({{ $course->lessons->count() }})</h2>

    @if($course->lessons->isEmpty())
        <p class="text-gray-500 dark:text-gray-400">No lessons added yet.</p>
    @else
        <div class="space-y-4">
            @foreach($course->lessons as $lesson)
                <div class="border border-gray-200 dark:border-gray-700 rounded-lg p-6 hover:border-primary transition-colors">
                    <div class="flex justify-between items-start">
                        <div class="flex-1">
                            <h3 class="text-lg font-semibold mb-2">{{ $lesson->title }}</h3>
                            <p class="text-gray-700 dark:text-gray-300">{{ Str::limit($lesson->content, 200) }}</p>
                        </div>

                        @auth
                            @if(Auth::user()->id === $course->user_id)
                                <div class="flex space-x-2 ml-4">
                                    <a href="{{ route('instructor.lessons.edit', [$course, $lesson]) }}" 
                                       class="text-yellow-500 hover:text-yellow-600 font-medium">
                                        Edit
                                    </a>
                                    <form action="{{ route('instructor.lessons.destroy', [$course, $lesson]) }}" method="POST" class="inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="text-red-500 hover:text-red-600 font-medium"
                                                onclick="return confirm('Are you sure you want to delete this lesson?')">
                                            Delete
                                        </button>
                                    </form>
                                </div>
                            @endif
                        @endauth
                    </div>
                </div>
            @endforeach
        </div>
    @endif
</div>
@endsection