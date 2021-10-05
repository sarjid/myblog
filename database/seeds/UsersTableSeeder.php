<?php

use App\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
          [
            'username' => 'admin1',
            'name' => 'admin',
            'role_id' => 1,
            'email' => 'admin@gmail.com',
            'password' => Hash::make('password'),
          ],
          [
            'username' => 'user101',
            'name' => 'user',
            'role_id' => 2,
            'email' => 'user@gmail.com',
            'password' => Hash::make('password'),
          ],
        ]);
    }
}
