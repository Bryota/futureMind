<?php

namespace Database\Factories\DataProvider\Eloquent;

use App\DataProvider\Eloquent\SelfDiagnosisData;
use App\DataProvider\Eloquent\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class SelfDiagnosisDataFactory extends Factory
{
    /**
     * model
     *
     * @var string
     */
    protected $model = SelfDiagnosisData::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'user_id' => User::factory(),
            'developmentvalue' => $this->faker->numberBetween($min=3,$max=15),
            'socialvalue' => $this->faker->numberBetween($min=3,$max=15),
            'stablevalue' => $this->faker->numberBetween($min=3,$max=15),
            'teammatevalue' => $this->faker->numberBetween($min=3,$max=15),
            'futurevalue' => $this->faker->numberBetween($min=3,$max=15)
        ];
    }

    public function userAs($user)
    {
        return $this->state(function (array $attributes) use($user) {
            return [
                'user_id' => $user->id
            ];
        });
    }
}
