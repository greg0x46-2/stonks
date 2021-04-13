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
                ['code' => 'BTC', 'name' => 'Bitcoin', 'type' => 'crypto'],
                ['code' => 'ETH', 'name' => 'Ethereum', 'type' => 'crypto'],
                ['code' => 'XRP', 'name' => 'Ripple', 'type' => 'crypto']
            ]);
    }
}
