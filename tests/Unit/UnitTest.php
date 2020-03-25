<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use App\User;

class UnitTest extends TestCase
{
    // Tests to make sure that the contact form submits as expected
    public function testContactSubmission()
    {
        $response = $this->json('POST', '/contact', ['name' => 'Sally', 'email' => 'test@test.com', 'number' => '123456789', 'message' => 'A test message']);

        $response->assertStatus(200);
    }

    // // Tests to make sure that the car search functionality is working
    public function testCarSearch()
    {
        $response = $this->json('POST', '/cars', ['manufacturers' => 'All Makes', 'fuel' => 'Any Fuel Type', 'gearbox' => 'All Transmission Types', 'miles' => '', 'mpg' => '', 'tax' => '']);

        $response->assertStatus(200);
    }

    // Tests the car compare feature to make sure it is working
    public function testCarCompare()
    {
        $response = $this->json('POST', '/getCompareDetails', ['id' => '4', 'existingID' => '5']);

        $response->assertStatus(200);
    }
}
