<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AssetSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('assets')
            ->insert([
                ['code' => 'BTC', 'name' => 'Bitcoin', 'type' => 'crypto', 'created_at' => now(), 'updated_at' => now()],
                ['code' => 'ETH', 'name' => 'Ethereum', 'type' => 'crypto', 'created_at' => now(), 'updated_at' => now()],
                ['code' => 'XRP', 'name' => 'Ripple', 'type' => 'crypto', 'created_at' => now(), 'updated_at' => now()],
                ['code' => 'LTC', 'name' => 'Litecoin', 'type' => 'crypto', 'created_at' => now(), 'updated_at' => now()],
                ['code' => 'BCH', 'name' => 'Bitcoin Cash', 'type' => 'crypto', 'created_at' => now(), 'updated_at' => now()],
                ['code' => 'EOS', 'name' => 'EOS', 'type' => 'crypto', 'created_at' => now(), 'updated_at' => now()],
                ['code' => 'DAI', 'name' => 'DAI', 'type' => 'crypto', 'created_at' => now(), 'updated_at' => now()]
            ]);
    }
}
