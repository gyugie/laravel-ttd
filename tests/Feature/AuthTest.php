<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\User;
use DB;

class AuthTest extends TestCase
{
    use RefreshDatabase, DatabaseMigrations;
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testExample()
    {
        $response = $this->get('/');

        $response->assertStatus(200);
    }

    
    /**
     * test registration user
     * 
     * @test
     */

     public function test_register(){
        $data = [
            'email' => 'test@gmail.com',
            'name' => 'Test',
            'password' => 'secret1234',
            'password_confirmation' => 'secret1234',
        ];

        $response = $this->json('POST',route('api.register'),$data)
                    ->assertStatus(200);

                    $this->assertArrayHasKey('token',$response->json());
     }

     /**
     * test user login
     * @test
     */

    public function user_login(){
        User::create([
            'name'     => 'test',
            'email'    => 'email@gmail.com',
            'password' => bcrypt('secret1234')
        ]);

        $response = $this->json('POST', route('api.authenticate'), [
            'email'     => 'email@gmail.com',
            'password'  => 'secret123'
        ]);

        $response->assertStatus(401);

        $this->assertArrayHasKey('token', $response->json());

    }


}
