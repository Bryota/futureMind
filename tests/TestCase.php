<?php

namespace Tests;

use App\DataProvider\Eloquent\User;
use App\DataProvider\Eloquent\Company;
use App\DataProvider\Eloquent\Admin;
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

    public function loginAsCompany(Company $company = null)
    {
        $company = $company ?? Company::factory()->create();

        $this->actingAs($company, 'company');

        return $company;
    }

    public function loginAsAdmin(Admin $admin = null)
    {
        $admin = $admin ?? Admin::factory()->create();

        $this->actingAs($admin, 'admin');

        return $admin;
    }
}
