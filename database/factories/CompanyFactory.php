<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\models\Company;
use App\models\CompanyDiagnosisData;
use Faker\Generator as Faker;

$factory->define(Company::class, function (Faker $faker) {
    return [
        'name' => $faker->company,
        'email' => $faker->unique()->safeEmail,
        'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
        'company_icon' => 'DailyUI day11 flash message_1606489740.png',
        'industry' => $faker->randomElement(['メーカー','商社','マスコミ','物流','不動産','IT','医療','教育','流通','金融','コンサルティング','環境','その他']),
        'office' => $faker->address,
        'employee' => $faker->numberBetween($min=10,$max=10000),
        'homepage' => $faker->url,
        'comment' => $faker->realText(50),
        
    ];
});

$factory->define(CompanyDiagnosisData::class, function (Faker $faker) {
    return [
        'developmentvalue' => $faker->numberBetween($min=1,$max=5),
        'socialvalue' => $faker->numberBetween($min=1,$max=5),
        'stablevalue' => $faker->numberBetween($min=1,$max=5),
        'teammatevalue' => $faker->numberBetween($min=1,$max=5),
        'futurevalue' => $faker->numberBetween($min=1,$max=5),
        'user_id' => function(){
            return factory(Company::class)->create()->id;
        },
        
    ];
});
