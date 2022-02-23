<?php

namespace Database\Factories\DataProvider\Eloquent;

use App\DataProvider\Eloquent\CompanyDiagnosisData;
use App\DataProvider\Eloquent\Company;
use Illuminate\Database\Eloquent\Factories\Factory;

class CompanyDiagnosisDataFactory extends Factory
{
    /**
     * model
     *
     * @var string
     */
    protected $model = CompanyDiagnosisData::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'user_id' => Company::factory(),
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
