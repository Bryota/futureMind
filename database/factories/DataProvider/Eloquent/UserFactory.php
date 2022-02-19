<?php

namespace Database\Factories\DataProvider\Eloquent;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class UserFactory extends Factory
{
    private $GraduateYear = [
        '2022年',
        '2023年',
        '2024年',
        '2025年',
        '2026年',
        '2027年'
    ];
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->name,
            'year' => $this->faker->randomElement($this->GraduateYear),
            'university' => $this->faker->realText(10),
            'email' => $this->faker->unique()->safeEmail(),
            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
            'remember_token' => Str::random(10)
        ];
    }

    public function ValidData($overrides = [])
    {
        $validData = [
            'name' => 'user',
            'email' => 'example@example.com',
            'year' => '2022年',
            'university' => 'テスト大学',
            'password' => 'password'
        ];

        return array_merge($validData, $overrides);
    }
}
