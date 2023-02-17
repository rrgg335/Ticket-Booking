<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class UserTest extends TestCase
{
    /**
     * A basic feature test example.
     */
    public function test_example(): void
    {
        $response = $this->call('post','api/signin',[
            'email'=>'test@example.com',
            'password'=>'12345678'
        ]);

        $response->assertStatus(200);
    }
}
