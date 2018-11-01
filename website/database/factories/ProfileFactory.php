<?php

use Faker\Generator as Faker;

$factory->define(App\Model\Profile::class, function (Faker $faker) {
    return [
        'firstname' => $faker->word,
        'lastname' => $faker->lastName,
        'street' => $faker->streetName,
        'parish' => $faker->state,
        'mobile' => $faker->phoneNumber,
        'landline' => $faker->phoneNumber,
        'farm_name' => $faker->company,
        'farm_address_steet' => $faker->streetName,
        'farm_address_parish' => $faker->state,
        'flock_capacity' => $faker->randomDigit,
        'principal_occupation' => $faker->jobTitle,
        'qualifications' => $faker->text($maxNbChars = 255),
        'training' => $faker->text($maxNbChars = 255),
        'user_id' => function(){
            return App\User::all()->random();
        }
    ];
});
