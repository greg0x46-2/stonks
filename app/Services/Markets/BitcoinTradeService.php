<?php


namespace App\Services\Markets;


use App\Models\Asset;
use Illuminate\Support\Facades\Http;

class BitcoinTradeService extends MarketService
{
    const ORIGIN = 'Bitcoin Trade';
    const URL = 'https://api.bitcointrade.com.br/';
    const CURRENT = 'BRL';

    public function summary(Asset $asset): array
    {
        return cache()->remember(get_called_class() . 'currency' . $asset->code, 300, function () use ($asset) {
            $response = Http::withHeaders([
                'Content-Type' => 'application/json',
                'x-api-key' => env('BT_API_TOKEN')
            ])->get(self::URL . 'v3/market/summary?pair=' . self::CURRENT . $asset->code)
                ->json();

            return [
                'asset_id' => $asset->id,
                'market_id' => $this->market->id,
                'pair' => $response['data'][0]['pair'],
                'price' => $response['data'][0]['last_transaction_unit_price'],
                'price_at' => now(),
                'volume' => $response['data'][0]['volume_24h'],
                'max_price' => $response['data'][0]['max_price'],
                'min_price' => $response['data'][0]['min_price'],
            ];
        });
    }
}
