<?php

namespace Tests\Unit;

use App\Models\Course;
use App\Models\Lesson;
use App\Models\Enrollment;
use App\Models\User;
use Tests\TestCase;

class ModelsTest extends TestCase
{
    public function test_course_model_fillable()
    {
        $course = new Course();
        $this->assertEquals(
            ['user_id', 'title', 'short_description', 'content', 'thumbnail'],
            $course->getFillable()
        );
    }

    public function test_lesson_model_fillable()
    {
        $lesson = new Lesson();
        $this->assertEquals(
            ['course_id', 'title', 'content', 'order'],
            $lesson->getFillable()
        );
    }

    public function test_enrollment_model_fillable()
    {
        $enrollment = new Enrollment();
        $this->assertEquals(
            ['course_id', 'user_id', 'completed'],
            $enrollment->getFillable()
        );
    }

    public function test_user_has_instructor_role_check()
    {
        $instructor = new User(['role' => 'instructor']);
        $this->assertTrue($instructor->isInstructor());
        $this->assertFalse($instructor->isStudent());
    }

    public function test_user_has_student_role_check()
    {
        $student = new User(['role' => 'student']);
        $this->assertTrue($student->isStudent());
        $this->assertFalse($student->isInstructor());
    }
}