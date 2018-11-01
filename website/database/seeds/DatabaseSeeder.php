<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        factory(App\User::class, 50) -> create();
        // $this->call(UsersTableSeeder::class);
        factory(App\Model\Product::class, 50) -> create();
        factory(App\Model\Profile::class, 50) -> create();

    }
}
