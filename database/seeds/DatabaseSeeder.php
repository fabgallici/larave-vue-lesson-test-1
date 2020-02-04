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
        $this->call([

          TagSeeder::class,
          UserSeeder::class,
          // UserInfoSeeder::class,
          PostSeeder::class

        ]);
    }
}
