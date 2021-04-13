<?php

namespace Database\Seeders;

use App\Models\Asset;
use App\Models\Market;
use Illuminate\Database\Seeder;

class MarketSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Market::create(['name' => 'Bitcoin Trade'])->assets()->attach([
            Asset::findByCode('btc')->id,
            Asset::findByCode('eth')->id,
            Asset::findByCode('xrp')->id,
            Asset::findByCode('ltc')->id,
            Asset::findByCode('bch')->id,
            Asset::findByCode('eos')->id,
            Asset::findByCode('dai')->id
        ]);
    }
}
