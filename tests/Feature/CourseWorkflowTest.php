<?php

namespace Tests\Feature;

use App\Models\User;
use App\Models\Course;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class CourseWorkflowTest extends TestCase
{
    use RefreshDatabase;

    public function test_guest_can_view_courses_list()
    {
        $response = $this->get('/courses');
        $response->assertStatus(200);
    }

    public function test_student_can_view_courses()
    {
        $user = User::factory()->create(['role' => 'student']);
        
        $response = $this->actingAs($user)->get('/courses');
        
        $response->assertStatus(200);
    }

    public function test_instructor_can_create_course()
    {
        $instructor = User::factory()->create(['role' => 'instructor']);
        
        $response = $this->actingAs($instructor)->post('/instructor/courses', [
            'title' => 'Test Course',
            'short_description' => 'This is a test course description.',
            'content' => 'Detailed content for the test course.',
        ]);

        $response->assertRedirect(route('instructor.dashboard'));
        $this->assertDatabaseHas('courses', [
            'title' => 'Test Course',
            'user_id' => $instructor->id,
        ]);
    }

    public function test_student_cannot_create_course()
    {
        $student = User::factory()->create(['role' => 'student']);
        
        $response = $this->actingAs($student)->get('/instructor/courses/create');
        
        $response->assertRedirect('/');
    }

    public function test_instructor_can_update_their_course()
    {
        $instructor = User::factory()->create(['role' => 'instructor']);
        $course = Course::factory()->create(['user_id' => $instructor->id]);
        
        $response = $this->actingAs($instructor)->put("/instructor/courses/{$course->id}", [
            'title' => 'Updated Title',
            'short_description' => 'Updated description',
            'content' => 'Updated content',
        ]);

        $response->assertRedirect(route('instructor.dashboard'));
        $this->assertDatabaseHas('courses', [
            'id' => $course->id,
            'title' => 'Updated Title',
        ]);
    }

    public function test_instructor_cannot_update_others_course()
    {
        $instructor1 = User::factory()->create(['role' => 'instructor']);
        $instructor2 = User::factory()->create(['role' => 'instructor']);
        $course = Course::factory()->create(['user_id' => $instructor1->id]);
        
        $response = $this->actingAs($instructor2)->put("/instructor/courses/{$course->id}", [
            'title' => 'Hacked Title',
            'short_description' => 'Hacked description',
            'content' => 'Hacked content',
        ]);

        $response->assertStatus(403);
    }

    public function test_student_can_enroll_in_course()
    {
        $student = User::factory()->create(['role' => 'student']);
        $course = Course::factory()->create();
        
        $response = $this->actingAs($student)->post("/student/courses/{$course->id}/enroll");

        $response->assertRedirect();
        $this->assertDatabaseHas('enrollments', [
            'user_id' => $student->id,
            'course_id' => $course->id,
        ]);
    }

    public function test_student_can_unenroll_from_course()
    {
        $student = User::factory()->create(['role' => 'student']);
        $course = Course::factory()->create();
        
        // First enroll
        $this->actingAs($student)->post("/student/courses/{$course->id}/enroll");
        
        // Then unenroll
        $response = $this->actingAs($student)->delete("/student/courses/{$course->id}/unenroll");

        $response->assertRedirect();
        $this->assertDatabaseMissing('enrollments', [
            'user_id' => $student->id,
            'course_id' => $course->id,
        ]);
    }
}