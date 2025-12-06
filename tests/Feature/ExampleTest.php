<?php

namespace Tests\Feature;

use Tests\TestCase;

class ExampleTest extends TestCase
{
    public function test_the_application_returns_a_successful_response(): void
    {
        $response = $this->get('/');

        // Accept either 200 or 302 (redirect)
        $this->assertContains($response->status(), [200, 302]);
    }
}