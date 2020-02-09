<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

use App\User;

class AuthTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */

    public $routes = [

        '/',
        '/admin/groups',
        '/admin/groups/create',
        '/admin/tasks',


    ];

    public function testAdmin()
    {
        $user = factory(User::class)->states('admin')
                                    ->make();

        foreach($this->routes as $route)
        {
            $response = $this->actingAs($user)
                         ->get($route);
            $response->assertStatus(200);

        }

    }


    public function testDash()
    {
        $user = factory(User::class)->states('user')
                                    ->make();
        $response = $this->actingAs($user)
                        ->get('/');
        $response->assertStatus(200);

    }

    public function testGroups()
    {
        $user = factory(User::class)->states('user')
                                    ->make();
        $response = $this->actingAs($user)
                        ->get('/admin/groups');
        $response->assertStatus(302);

    }

}
