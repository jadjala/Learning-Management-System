<?php
namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\Enrollment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class EnrollmentController extends Controller
{

    public function store(Course $course)
    {
        $exists = Enrollment::where('course_id', $course->id)
            ->where('user_id', Auth::id())
            ->exists();

        if ($exists) {
            return back()->with('info', 'You are already enrolled in this course.');
        }

        Enrollment::create([
            'course_id' => $course->id,
            'user_id' => Auth::id(),
            'completed' => false,
        ]);

        return back()->with('success', 'Successfully enrolled in the course!');
    }

    public function destroy(Course $course)
    {
        Enrollment::where('course_id', $course->id)
            ->where('user_id', Auth::id())
            ->delete();

        return back()->with('success', 'Successfully unenrolled from the course.');
    }

    public function toggleComplete(Course $course)
    {
        $enrollment = Enrollment::where('course_id', $course->id)
            ->where('user_id', Auth::id())
            ->firstOrFail();

        $enrollment->update(['completed' => !$enrollment->completed]);

        return back()->with('success', 'Course completion status updated!');
    }
}
