<?php

use Faker\Generator as Faker;
use Carbon\Carbon;
/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| This directory should contain each of the model factory definitions for
| your application. Factories provide a convenient way to generate new
| model instances for testing / seeding your application's database.
|
*/

  $factory->define(App\Models\Teacher::class, function (Faker $faker) {
    return [
        'fname' => $faker->firstName,
        'lname' => $faker->lastName,
        'email' => $faker->unique()->safeEmail,
        'dob' => Carbon::now()->toDateString(),
        'gender'=>'male',
        'contact'=>$faker->phoneNumber,
        'religion'=>'Budha',
        'user_id'=>8,
        'contact_id'=>1,
        'academic_info_id'=>1,
        'school_id'=>1,
    ];
});
