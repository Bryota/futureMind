<?php

use Illuminate\Database\Seeder;

class LikesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('likes')->insert([
            [
                'user_id'=>1,
                'company_id'=>1
            ],
            [
                'user_id'=>1,
                'company_id'=>2
            ],
    ]);
    }
}
