<?php


namespace App\Services\Markets;


use App\Models\Asset;
use Illuminate\Cache\RateLimiter;
use Illuminate\Support\Facades\Http;

class BitcoinTradeService extends MarketService
{
    const URL = 'https://api.bitcointrade.com.br/';
    const TPS = 1;
    const CURRENT = 'BRL';

    public function summary(Asset $asset): array
    {
        $key = get_called_class() . 'currency' . $asset->code;

        if (cache()->has($key)) {
            return cache()->get($key);
        }

        $this->throttle();

        $response = Http::withHeaders([
            'Content-Type' => 'application/json',
            'x-api-key' => env('BT_API_TOKEN')
        ])->get(self::URL . 'v3/market/summary?pair=' . self::CURRENT . $asset->code);

        if ($response->successful()) {
            $decoded = $response->json();

            return cache()->remember(get_called_class() . 'currency' . $asset->code, 295, function () use ($asset, $decoded) {
                return [
                    'asset_id' => $asset->id,
                    'market_id' => $this->market->id,
                    'pair' => $decoded['data'][0]['pair'],
                    'price' => $decoded['data'][0]['last_transaction_unit_price'],
                    'price_at' => now(),
                    'volume' => $decoded['data'][0]['volume_24h'],
                    'max_price' => $decoded['data'][0]['max_price'],
                    'min_price' => $decoded['data'][0]['min_price'],
                ];
            });
        }

        throw new \Exception("Couldn't get summary from asset $asset->code HTTP status: " . $response->status());
    }

    /**
     * Apply TPS
     *
     * @return $this
     */
    public function throttle()
    {
        $limiter = app(RateLimiter::class);

        while ($limiter->tooManyAttempts('TPS_' . get_called_class(), self::TPS)) {
            sleep(1);
        }

        $limiter->hit('TPS_' . get_called_class(), 1);

        return $this;
    }
}
