<?php

namespace Database\Factories\DataProvider\Eloquent;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Http\UploadedFile;
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

    private $Industry = [
        'メーカー',
        '商社',
        'マスコミ',
        '物流',
        '不動産',
        'IT',
        '医療',
        '教育',
        '流通',
        '金融',
        'コンサルティング',
        '環境',
        'その他'
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

    public function ValidUpdateData($overrides = [])
    {
        $validData = [
            'name' => 'user_update',
            'email' => 'example_update@example.com',
            'year' => '2023年',
            'university' => 'テスト_アップデート大学',
            'club' => '山岳部',
            'hobby' => '波紋の呼吸',
            'hometown' => '東京',
            'img_name' => UploadedFile::fake()->image('test.jpg'),
            'industry' => $this->faker->randomElement($this->Industry),
        ];

        return array_merge($validData, $overrides);
    }
}
