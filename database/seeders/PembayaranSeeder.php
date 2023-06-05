<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Illuminate\Support\Carbon;


class PembayaranSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $kategori_id = DB::table('kategori_pembayaran')->pluck('id');
        $attribute_id = DB::table('attribute_pembayaran')->pluck('id');
        $item_id = DB::table('item_pembayaran')->pluck('id');

        DB::table('pembayaran')->insert([
            'id' => Str::uuid(),
            'kategori_pembayaran_id' => fake()->randomElement($kategori_id),
            'nama' => 'Halim',
            'nim' => '2103012',
            'email' => 'halim@gmail.com',
            'phone' => '08523643626',
            'address' => 'jalan sindang indramayu',
            'semester' => '1',
            'tahun_akademik' => '2022/2023',
            'prodi' => 'Teknik Informatika',
            'va' => '2103012',
            'amount' => '5000000',
            'status' => true,
            'activeDate' => Carbon::now(),
            'inactiveDate' => Carbon::now(),
            'date' => Carbon::now(),
            'attribute_pembayaran_id' => fake()->randomElement($attribute_id),
            'item_pembayaran_id' => fake()->randomElement($item_id)
        ]);

        DB::table('pembayaran')->insert([
            'id' => Str::uuid(),
            'kategori_pembayaran_id' => fake()->randomElement($kategori_id),
            'nama' => 'David',
            'nim' => '2103007',
            'email' => 'david@gmail.com',
            'phone' => '08545645463',
            'address' => 'jalan jalan terus',
            'semester' => '2',
            'tahun_akademik' => '2022/2023',
            'prodi' => 'Teknik Informatika',
            'va' => '2103007',
            'amount' => '5000000',
            'status' => true,
            'activeDate' => Carbon::now(),
            'inactiveDate' => Carbon::now(),
            'date' => Carbon::now(),
            'attribute_pembayaran_id' => fake()->randomElement($attribute_id),
            'item_pembayaran_id' => fake()->randomElement($item_id)
            
        ]);
        
        DB::table('pembayaran')->insert([
            'id' => Str::uuid(),
            'kategori_pembayaran_id' => fake()->randomElement($kategori_id),
            'nama' => 'Ibnu',
            'nim' => '2103014',
            'email' => 'ibnu@gmail.com',
            'phone' => '08534242465',
            'address' => 'jalan jatisawit',
            'semester' => '1',
            'tahun_akademik' => '2022/2023',
            'prodi' => 'Teknik Informatika',
            'va' => '2103014',
            'amount' => '4000000',
            'status' => false,
            'activeDate' => Carbon::now(),
            'inactiveDate' => Carbon::now(),
            'date' => Carbon::now(),
            'attribute_pembayaran_id' => fake()->randomElement($attribute_id),
            'item_pembayaran_id' => fake()->randomElement($item_id)
        ]);
    }
}
