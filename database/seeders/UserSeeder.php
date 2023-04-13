<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        DB::table('users')->insert([
            'name' => 'Super Admin',
            'username' => 'superadmin',
            'email' => 'superadmin@gmail.com',
            'no_hp' => '08512345678',
            'id_level' => 1,
            'password' => Hash::make('superadmin123'),
        ]);
        
        DB::table('users')->insert([
            'name' => 'Admin Keuangan',
            'username' => 'adminkeuangan',
            'email' => 'adminkeuangan@gmail.com',
            'no_hp' => '08534523678',
            'id_level' => 2,
            'password' => Hash::make('adminkeuangan123'),
        ]);

        DB::table('users')->insert([
            'name' => 'Admin Apps',
            'username' => 'adminapps',
            'email' => 'adminapps@gmail.com',
            'no_hp' => '085674834534',
            'id_level' => 3,
            'password' => Hash::make('adminapps123'),
        ]);

    }
}
