<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\User;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class AuthTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function register_page_rendered()
    {
        // render view register
        $this->get('register')->assertStatus(200);
    }

    /** @test */
    public function register_acc()
    {
        //buat akun
        $user = User::factory()->make();

        // post akun
        $response = $this->post('register', $user->toArray());

        //redirect user
        $response->assertRedirect('/login');
    }

    /** @test */
    public function login_page_rendered()
    {
        // render view login
        $this->get('login')->assertStatus(200);
    }

    /** @test */
    public function login_post_acc()
    {
        // $this->withoutExceptionHandling();

        //create fake user
        $user = User::factory()->create();

        // login dan stored session
        $response = $this->actingAs($user)
                         ->withSession(['loginId' => $user->id, "nama" => $user->name, "level" => $user->level]);
                         
        //redirect user ke dashboard
        $response->get('/dashboard')->assertStatus(200);
    }

}
