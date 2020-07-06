<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'name' => 'admin',
            'email' => 'admin@gmail.com',
            'password' => Hash::make('123456789'),
            'api_token' => Str::random(60),
            'isAdmin' => true,
        ]);

        DB::table('users')->insert([
            'name' => 'badr',
            'email' => 'badr@gmail.com',
            'password' => Hash::make('123456789'),
            'api_token' => Str::random(60),
            'isAdmin' => false,
        ]);
    }
}
