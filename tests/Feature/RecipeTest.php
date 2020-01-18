<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Hash;
use Tests\TestCase;
use App\User;
use JWTAuth;
use DB;

class RecipeTest extends TestCase
{
    use DatabaseMigrations, RefreshDatabase;
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

    protected function authtenticate(){
        $user = User::create([
            'name'  => 'tes',
            'email' => 'email@gmail.com',
            'password' =>  Hash::make('secret1234'),
        ]);

        $token = JWTAuth::fromUser($user);

        return $token;
    }

    public function test_create_recipe(){
        $this->withoutExceptionHandling();
        $token      = $this->authtenticate();
        $response   = $this->withHeaders([
            'Authorization' => 'Bearer '. $token,
        ])->json('POST', route('recipe.create'),[
            'title'     => 'Jollo',
            'procedure' => 'Pablo amous laba '
        ]);

        $response->assertStatus(200);
        

    }
}
