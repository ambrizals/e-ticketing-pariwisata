<?php

use Illuminate\Database\Seeder;

class userTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'name' => 'Administrator',
            'email' => 'admin@localhost.com',
            'email_verified_at' => null,
            'password' => bcrypt('admin1234'),
            'is_management' => true,
            'level' => 1
        ]);
        DB::table('users')->insert([
            'name' => 'Kasir',
            'email' => 'kasir@localhost.com',
            'email_verified_at' => null,
            'password' => bcrypt('kasir1234'),
            'is_management' => true,
            'level' => 1
        ]);
        DB::table('users')->insert([
            'name' => 'User',
            'email' => 'user@localhost.com',
            'email_verified_at' => null,
            'password' => bcrypt('user1234'),
            'is_management' => false,
            'level' => 0
        ]);
        DB::table('users')->insert([
            'name' => 'User2',
            'email' => 'user2@localhost.com',
            'email_verified_at' => null,
            'password' => bcrypt('user1234'),
            'is_management' => false,
            'level' => 0
        ]);
    }
}
