<?php

use Faker\Generator as Faker;
use App\Company;

$factory->define(Company::class, function (Faker $faker) {

    return [
        'name' => $faker->company,
        'email' => $faker->companyEmail,
        'logo' => $faker->image('storage/app/public', 100, 100, null, false),
        'website' => $faker->url
    ];
});
