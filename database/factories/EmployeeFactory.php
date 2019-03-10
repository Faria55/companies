<?php

use Faker\Generator as Faker;
use App\Company;
use App\Employee;

$factory->define(Employee::class, function (Faker $faker) {

    $company_ids = Company::all()->pluck('id')->toArray();

    return [
        'first_name' => $faker->firstName(),
        'last_name' => $faker->lastName(),
        'company_id' => $faker->randomElement($company_ids),
        'email' => $faker->email,
        'phone' => $faker->phoneNumber,
    ];
});
