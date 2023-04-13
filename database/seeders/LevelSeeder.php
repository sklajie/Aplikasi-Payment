<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class LevelSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('users')->insert([
            'name_level' => 'Super Admin'
        ]);
        DB::table('users')->insert([
            'name_level' => 'Admin Keuangan'
        ]);
        DB::table('users')->insert([
            'name_level' => 'Admin Apps'
        ]);
    }
}
