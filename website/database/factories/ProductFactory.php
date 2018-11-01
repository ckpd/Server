<?php

use Faker\Generator as Faker;

$factory->define(App\Model\Product::class, function (Faker $faker) {
    return [


        'name' => $faker->word,
        'detail' => $faker->paragraph,
        'price' => $faker->randomFloat,
        'stock' => $faker->randomDigit,
        'discount' => $faker->randomFloat,
        'user_id' => function(){
            return App\User::all()->random();
        }
        // $table->string('name');
        // $table->double('price');
        // $table->text('detail');
        // $table->integer('stock');
        // $table->double('discount');
        // $table->timestamps();    
    ];
});
