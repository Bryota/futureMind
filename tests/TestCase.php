<?php

namespace Tests;

use App\DataProvider\Eloquent\User;
use Illuminate\Foundation\Testing\TestCase as BaseTestCase;

abstract class TestCase extends BaseTestCase
{
    use CreatesApplication;

    public function loginAsUser(User $user = null)
    {
        $user = $user ?? User::factory()->create();

        $this->actingAs($user);

        return $user;
    }
}
