<?php

namespace Tests\Feature;

use App\DataProvider\Eloquent\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Hash;
use Tests\TestCase;

class AuthTest extends TestCase
{
    use RefreshDatabase;

    /**
     * @test
     * App\Http\Controllers\Auth\RegisterController @register
     */
    public function ユーザー登録ができる()
    {
        $this->get('register')
            ->assertOk();

        $validData = User::factory()->validData();
        $this->post(route('register'), $validData)
            ->assertStatus(302);

        unset($validData['password']);

        $this->assertDatabaseHas('users', $validData);

        $user = User::firstWhere($validData);

        $this->assertTrue(Hash::check('password', $user->password));
    }
}
