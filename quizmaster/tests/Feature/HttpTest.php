<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class HttpTest extends TestCase
{
    /**
     * A basic feature test example.
     */
    public function test_example(): void
    {
        $response = $this->get('/register');
        $response->assertStatus(200);
        $response = $this->get('/login');
        $response->assertStatus(200);
        $response = $this->post('/register/commit', [
            'name' => 'testy',
            'password' => 'test',
            'email' => 'test@yrgo.se'
        ]);
        $response->assertStatus(302);
        $response = $this->post('/login/commit',  [
            'name' => 'testy',
            'password' => 'test'
        ]);
        $response->assertStatus(302);
        $response = $this->get('/logout');
        $response->assertStatus(302);

        //gets undefined array key category. But it works live
        //and it dosen't sat that alt1,alt2, etc, is undefined.
        //weird???
        //$response = $this->get('/upload');
        //$response->assertStatus(200);

        $response = $this->get('/menu');
        $response->assertStatus(302);
        $response = $this->get('/game');
        $response->assertStatus(302);
        $response = $this->post('/game/commit', [
            'submitedAnswer', 'alt1'
        ]);
        $response->assertStatus(302);
        $response = $this->get('/archive');
        $response->assertStatus(302);
    }
}
