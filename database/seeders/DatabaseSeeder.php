<?php
namespace Database\Seeders;

use App\Models\User;
use App\Models\Course;
use App\Models\Lesson;
use App\Models\Enrollment;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        // Create instructor
        $instructor = User::create([
            'name' => 'John Instructor',
            'email' => 'instructor@example.com',
            'password' => Hash::make('password'),
            'role' => 'instructor',
        ]);

        // Create student
        $student = User::create([
            'name' => 'Jane Student',
            'email' => 'student@example.com',
            'password' => Hash::make('password'),
            'role' => 'student',
        ]);

        // Create courses
        $course1 = Course::create([
            'user_id' => $instructor->id,
            'title' => 'Introduction to Laravel',
            'short_description' => 'Learn the basics of Laravel framework and build your first web application.',
            'content' => 'This comprehensive course covers Laravel fundamentals including routing, controllers, views, and database integration.',
        ]);

        $course2 = Course::create([
            'user_id' => $instructor->id,
            'title' => 'Advanced PHP Programming',
            'short_description' => 'Master advanced PHP concepts and design patterns.',
            'content' => 'Deep dive into PHP OOP, design patterns, testing, and performance optimization.',
        ]);

        // Create lessons for course 1
        Lesson::create([
            'course_id' => $course1->id,
            'title' => 'Getting Started with Laravel',
            'content' => 'In this lesson, we will install Laravel and set up our development environment.',
            'order' => 1,
        ]);

        Lesson::create([
            'course_id' => $course1->id,
            'title' => 'Understanding Routes and Controllers',
            'content' => 'Learn how to define routes and create controllers to handle HTTP requests.',
            'order' => 2,
        ]);

        Lesson::create([
            'course_id' => $course1->id,
            'title' => 'Working with Blade Templates',
            'content' => 'Discover the power of Blade templating engine for building dynamic views.',
            'order' => 3,
        ]);

        // Create enrollment
        Enrollment::create([
            'course_id' => $course1->id,
            'user_id' => $student->id,
            'completed' => false,
        ]);

        $this->command->info('Database seeded successfully!');
        $this->command->info('Instructor: instructor@example.com / password');
        $this->command->info('Student: student@example.com / password');
    }
}