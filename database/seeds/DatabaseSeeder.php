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
        // App\User::factory(2000)->create();
        // $this->call(UserSeeder::class);
         $this->call(UsersTableSeeder::class);
         $this->call(RoleTableSeeder::class);
    }
}
