<?php
namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\Bookmark;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BookmarkController extends Controller
{
    public function toggle(Course $course)
    {
        $bookmark = Bookmark::where('user_id', Auth::id())
            ->where('course_id', $course->id)
            ->first();

        if ($bookmark) {
            $bookmark->delete();
            return back()->with('success', 'Course removed from bookmarks!');
        } else {
            Bookmark::create([
                'user_id' => Auth::id(),
                'course_id' => $course->id,
            ]);
            return back()->with('success', 'Course bookmarked!');
        }
    }

    public function index()
    {
        $bookmarkedCourses = Auth::user()
            ->bookmarkedCourses()
            ->with('instructor')
            ->latest('bookmarks.created_at')
            ->paginate(12);

        return view('bookmarks.index', compact('bookmarkedCourses'));
    }
}