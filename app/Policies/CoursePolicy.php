<?php
namespace App\Policies;

use App\Models\Course;
use App\Models\User;

class CoursePolicy
{
    public function update(User $user, Course $course)
    {
        return $user->id === $course->user_id;
    }

    public function delete(User $user, Course $course)
    {
        return $user->id === $course->user_id;
    }

    public function manageContent(User $user, Course $course)
    {
        return $user->id === $course->user_id;
    }
}