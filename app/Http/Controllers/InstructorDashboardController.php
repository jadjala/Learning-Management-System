<?php
namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;

class InstructorDashboardController extends Controller
{
    public function index()
    {
        $courses = Auth::user()
            ->courses()
            ->withCount(['lessons', 'enrollments'])
            ->latest()
            ->get();

        return view('instructor.dashboard', compact('courses'));
    }
}