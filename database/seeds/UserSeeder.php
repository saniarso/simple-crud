<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'name' => 'Super Admin',
            'email' => 'example@gmail.com',
            'no_hp' => '000000000000',
            'address' => 'Semarang',
            'username' => 'superadmin',
            'password' => Hash::make('superadmin'),
            'role' => 1
        ]);
    }
}
