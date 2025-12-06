<?php

namespace Database\Factories;

use App\Models\Course;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class EnrollmentFactory extends Factory
{
    public function definition()
    {
        return [
            'course_id' => Course::factory(),
            'user_id' => User::factory()->student(),
            'completed' => false,
        ];
    }
}