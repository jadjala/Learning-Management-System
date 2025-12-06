<?php
namespace App\Http\Controllers;

use App\Models\Course;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class CourseController extends Controller
{
    public function index()
    {
        $courses = Course::with('instructor')->latest()->paginate(12);
        return view('courses.index', compact('courses'));
    }

    public function show(Course $course)
    {
        $course->load(['instructor', 'lessons', 'enrollments']);
        $isEnrolled = Auth::check() && $course->students()->where('user_id', Auth::id())->exists();
        $isBookmarked = Auth::check() && $course->bookmarkedBy()->where('user_id', Auth::id())->exists();
        
        return view('courses.show', compact('course', 'isEnrolled','isBookmarked'));
    }

    public function create()
    {
        return view('instructor.courses.create');
    }

public function store(Request $request)
{
    $validated = $request->validate([
        'title' => 'required|string|max:255',
        'short_description' => 'required|string|max:500',
        'content' => 'required|string',
        'thumbnail' => 'nullable|image|max:2048',
    ]);

    $validated['user_id'] = Auth::id();

    // Handle thumbnail upload BEFORE creating course
    if($request->hasFile('thumbnail')) {
        $validated['thumbnail'] = $request->file('thumbnail')->store('thumbnails', 'public');
    }

    $course = Course::create($validated);

    return redirect()->route('instructor.dashboard')
        ->with('success', 'Course created successfully!');
}

    public function edit(Course $course)
    {
        if ($course->user_id !== Auth::id()) {
            abort(403, 'Unauthorized action.');
        }

        return view('instructor.courses.edit', compact('course'));
    }

   public function update(Request $request, Course $course)
{
    if ($course->user_id !== Auth::id()) {
        abort(403, 'Unauthorized action.');
    }

    $validated = $request->validate([
        'title' => 'required|string|max:255',
        'short_description' => 'required|string|max:500',
        'content' => 'required|string',
        'thumbnail' => 'nullable|image|max:2048',
    ]);

    // Handle thumbnail upload
    if($request->hasFile('thumbnail')) {
        // Delete old thumbnail if exists
        if ($course->thumbnail) {
            Storage::disk('public')->delete($course->thumbnail);
        }
        $validated['thumbnail'] = $request->file('thumbnail')->store('thumbnails', 'public');
    }

    $course->update($validated);

    return redirect()->route('instructor.dashboard')
        ->with('success', 'Course updated successfully!');
}

    public function destroy(Course $course)
    {
        if ($course->user_id !== Auth::id()) {
            abort(403, 'Unauthorized action.');
        }

        if ($course->thumbnail) {
            Storage::disk('public')->delete($course->thumbnail);
        }

        $course->delete();

        return redirect()->route('instructor.dashboard')
            ->with('success', 'Course deleted successfully!');
    }
}