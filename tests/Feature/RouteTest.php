<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Auth;

class RouteTest extends TestCase
{
    public function testRoutes()
    {
        $response = $this->get('/projekty');
        if(\Auth::check())
            $response->assertStatus(200);
        else
            $response->assertStatus(302);

        $response = $this->get('/login');
        $response->assertStatus(200);

        $response = $this->get('/register');
        $response->assertStatus(200);

        $response = $this->get('/home');
        if(\Auth::check())
            $response->assertStatus(200);
        else
            $response->assertStatus(302);
    }
}
