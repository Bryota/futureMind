<?php
namespace Database\Factories\DataProvider\Eloquent;

use App\DataProvider\Eloquent\Company;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Http\UploadedFile;

class CompanyFactory extends Factory
{
    /**
     * model
     *
     * @var string
     */
    protected $model = Company::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->company,
            'email' => $this->faker->unique()->safeEmail,
            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
            'company_icon' => UploadedFile::fake()->image('test.jpg'),
            'industry' => $this->faker->randomElement(['メーカー','商社','マスコミ','物流','不動産','IT','医療','教育','流通','金融','コンサルティング','環境','その他']),
            'office' => $this->faker->address,
            'employee' => $this->faker->numberBetween($min=10,$max=10000),
            'homepage' => $this->faker->url,
            'comment' => $this->faker->realText(50),
        ];
    }

    public function ValidData($overrides = [])
    {
        $validData = [
            'name' => $this->faker->company,
            'email' => $this->faker->unique()->safeEmail,
            'password' => 'password',
            'company_icon' => UploadedFile::fake()->image('test.jpg'),
        ];

        return array_merge($validData, $overrides);
    }

    public function ValidUpdateData($overrides = [])
    {
        $validData = [
            'name' => 'user_update',
            'company_icon' => UploadedFile::fake()->image('test_update.jpg'),
            'industry' => $this->faker->randomElement(['メーカー','商社','マスコミ','物流','不動産','IT','医療','教育','流通','金融','コンサルティング','環境','その他']),
            'office' => $this->faker->address,
            'employee' => $this->faker->numberBetween($min=10,$max=10000),
            'homepage' => $this->faker->url,
            'comment' => $this->faker->realText(50),
        ];

        return array_merge($validData, $overrides);
    }
}
