<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class PagesTest extends TestCase
{   
    // Tests to make sure the home page is working 
    public function testHomePage()
    {
        $response = $this->get('/');

        $response->assertStatus(200);
    }

    public function testAboutPage()
    {
        $response = $this->get('/about');

        $response->assertStatus(200);
    }

    public function testCarsPage()
    {
        $response = $this->get('/cars');

        $response->assertStatus(200);
    }

    public function testContactPage()
    {
        $response = $this->get('/contact');

        $response->assertStatus(200);
    }

}

// Tests the login functions to make sure expected results
class LoginTest extends TestCase
{
    public function testLoginFormWrong()
    {
        $credential = [
            'email' => 'test@test.com',
            'password' => 'testing'
        ];
    
        $response = $this->post('login',$credential);
    
        $response->assertSessionHasErrors();
    }

    public function testLoginFormCorrect()
    {
        $credential = [
            'email' => 'test@test.com',
            'password' => 'webapplication'
        ];
    
        $response = $this->post('login',$credential);
    
        $response->assertSessionHasNoErrors();
    }
}
