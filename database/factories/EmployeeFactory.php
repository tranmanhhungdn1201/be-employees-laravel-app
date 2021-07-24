<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Model;
use Faker\Generator as Faker;
use Illuminate\Support\Arr;

$factory->define(App\Models\Employee::class, function (Faker $faker) {
    return [
        'fullName' => $faker->name,
        'email' => $faker->unique()->safeEmail,
        'mobile' => $faker->phoneNumber(),
        'city' => $faker->city(),
        'gender' => Arr::random(['0', '1']),
        'departmentID' => Arr::random([1, 2, 3]),
        'hireDate' => now(),
        'isPermanent' => $faker->boolean()
    ];
});
