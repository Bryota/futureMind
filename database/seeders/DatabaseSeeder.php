<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // $this->call(UsersTableSeeder::class);
        // $this->call(CompaniesTableSeeder::class);
        // $this->call(CompanySeeder::class);
        $this->call(FutureCommentSeeder::class);
        $this->call(SelfCommentSeeder::class);
        $this->call(ToFutureCommentSeeder::class);
        // $this->call(FutureSingleCompanySeeder::class);
        // $this->call(SelfSingleCompanySeeder::class);
        // $this->call(LikesSeeder::class);
    }
}
