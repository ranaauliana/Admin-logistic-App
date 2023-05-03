<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class FiturBarangTest extends TestCase
{
    use RefreshDatabase;
    /** @test */
    public function admin_access_route_dashboard_successfully()
    {
        $response = $this->withSession(['loginId' => 1, "nama" => "dummy", "level" => "Admin"])->get('/dashboard');

        $response->assertStatus(200);
    }

    /** @test */
    public function user_access_route_dashboard_failed(){
        $response = $this->withSession(['loginId' => 1, "nama" => "dummy", "level" => "User"])->get('/dashboard');

        $response->assertStatus(302);
    }

    /** @test */
    // public function rendered_view_barang()
    // {
    //     $this->withoutExceptionHandling();
    //     $response = $this->withSession(['loginId' => 1, "nama" => "dummy", "level" => "User"])->get('');

    //     $response->assertSee('Barang');
    // }
}
