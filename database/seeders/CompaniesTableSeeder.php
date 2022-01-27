<?php

use Illuminate\Database\Seeder;

class CompaniesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('companies')->insert([
            'name'=> 'test_user',
            'email' => 'test_company@test.com',
            'password' => Hash::make('password123'),
            'remember_token'    => Str::random(10),
        ]);
    }
}
