<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Auth;

//class testing GET requests
class RouteTest extends TestCase
{
    public function testRoutes()
    {
        $response = $this->get('/login');
        $response->assertStatus(200);

        $response = $this->get('/register');
        $response->assertStatus(200);

        $response = $this->get('/home');
        if(\Auth::check())
            $response->assertStatus(200);
        else
            $response->assertStatus(302);

        $response = $this->get('/uzivatele');
        if(\Auth::check())
            $response->assertStatus(200);
        else
            $response->assertStatus(302);

        $response = $this->get('/uzivatel/1');
        if(\Auth::check())
            $response->assertStatus(200);
        else
            $response->assertStatus(302);

        $response = $this->get('/uzivatele/upravit/1');
        if(\Auth::check())
            $response->assertStatus(200);
        else
            $response->assertStatus(302);

        $response = $this->get('/uzivatele/vytvorit');
        if(\Auth::check())
            $response->assertStatus(200);
        else
            $response->assertStatus(302);

        $response = $this->get('/projekty');
        if(\Auth::check())
            $response->assertStatus(200);
        else
            $response->assertStatus(302);

        $response = $this->get('/projekty/vytvorit');
        if(\Auth::check())
            $response->assertStatus(200);
        else
            $response->assertStatus(302);

        $response = $this->get('/projekt/1');
        if(\Auth::check())
            $response->assertStatus(200);
        else
            $response->assertStatus(302);

        $response = $this->get('projekty/upravit/1');
        if(\Auth::check())
            $response->assertStatus(200);
        else
            $response->assertStatus(302);

        $response = $this->get('projekty/status/upravit/1');
        if(\Auth::check())
            $response->assertStatus(200);
        else
            $response->assertStatus(302);

        $response = $this->get('/projekty/faze/vsechny/1');
        if(\Auth::check())
            $response->assertStatus(200);
        else
            $response->assertStatus(302);

        $response = $this->get('/projekty/faze/upravit/1');
        if(\Auth::check())
            $response->assertStatus(200);
        else
            $response->assertStatus(302);

        $response = $this->get('projekty/faze/zmenit/1');
        if(\Auth::check())
            $response->assertStatus(200);
        else
            $response->assertStatus(302);
    }
}
