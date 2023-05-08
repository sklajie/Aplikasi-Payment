<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class LevelSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('levels')->insert([
            'id' => Str::uuid(),
            'nama_level' => 'Super Admin'
        ]);
        DB::table('levels')->insert([
            'id' => Str::uuid(),
            'nama_level' => 'Admin Keuangan'
        ]);
        DB::table('levels')->insert([
            'id' => Str::uuid(),
            'nama_level' => 'Admin Apps'
        ]);
    }
}
