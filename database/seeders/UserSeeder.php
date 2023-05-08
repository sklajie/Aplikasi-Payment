<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Illuminate\Support\Faker;
use Spatie\LaravelIgnition\Support\Composer\FakeComposer;


class UserSeeder extends Seeder
{

    
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $level_id= DB::table('levels')->pluck('id');

        DB::table('users')->insert([
            'id' => Str::uuid(),
            'name' => 'Super Admin',
            'username' => 'superadmin',
            'email' => 'superadmin@gmail.com',
            'level_id' => fake()->randomElement($level_id),
            'no_hp' => '08523643626',
            'mode' => 'prod',
            'password' => Hash::make('superadmin123'),
        ]);
        
        DB::table('users')->insert([
            'id' => Str::uuid(),
            'name' => 'Admin Keuangan',
            'username' => 'adminkeuangan',
            'email' => 'adminkeuangan@gmail.com',
            'level_id' => fake()->randomElement($level_id),
            'no_hp' => '08534523678',
            'mode' => 'prod',
            'password' => Hash::make('adminkeuangan123'),
        ]);

        DB::table('users')->insert([
            'id' => Str::uuid(),
            'name' => 'Admin Apps',
            'username' => 'adminapps',
            'email' => 'adminapps@gmail.com',
            'level_id' => fake()->randomElement($level_id),
            'no_hp' => '085674834534',
            'mode' => 'prod',
            'password' => Hash::make('adminapps123'),
        ]);

    }
}
