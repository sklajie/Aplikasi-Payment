<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {

        // $this->call(LevelSeeder::class);
        // $this->call(UserSeeder::class);
        // $this->call(KategoriPembayaranSeeder::class);
        // $this->call(ItemPembayaranSeeder::class);
        // $this->call(AttributePembayaranSeeder::class);
        $this->call(PembayaranSeeder::class);
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
    }
}
