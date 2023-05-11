<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\str;

class ItemPembayaranSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('item_pembayaran')->insert([
            'id' => Str::uuid(),
            'description' => 'Pembayaran UKT',
            'quantity' => '1',
            'itemPrice' => '5000000',
            'amount' => '5000000',
        ]);
    }
}
