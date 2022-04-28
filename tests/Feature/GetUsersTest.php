<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class GetUsersTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function SeeUsers()
    {
        $response = $this->get('/api/users');

        $response->assertStatus(200);
    }

    /** @test */
    public function getAllUsers()
    {
        User::factory(5)->create();

        $response = $this->getJson('/api/users')
            ->assertOk();

        $response->assertJsonCount(5, 'data');
    }

    /** @test */
    public function getOneUser()
    {
        $user = User::factory()->create();

        $this->getJson('/api/users/1')
            ->assertOk();
    }
}
