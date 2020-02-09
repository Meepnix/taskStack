<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

use App\User;

class ExampleTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function testBasicTest()
    {
        
        $user = factory(User::class)->states('admin')
                                    ->make();

        

        $response = $this->actingAs($user)
                         ->get('/');

        $response->assertStatus(200);

        $response = $this->actingAs($user)
                        ->get('/admin/groups');
        
        $response->assertStatus(200);
    }
}
