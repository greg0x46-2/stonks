<?php


namespace App\Services;


use Illuminate\Support\Facades\Http;

class BitcoinTradeService
{
    const ORIGIN = 'Bitcoin Trade';
    const URL = 'https://api.bitcointrade.com.br/';
    const CURRENT = 'BRL';

    public function currency(string $code): array
    {
        return cache()->remember(get_called_class() . 'currency' . $code, 300, function () use ($code) {
            $response = Http::withHeaders([
                'Content-Type' => 'application/json',
                'x-api-key' => env('BT_API_TOKEN')
            ])->get(self::URL . 'v3/market/summary?pair=' . self::CURRENT . $code);

            return [
                'code' => $code,
                'price' => $response['data'][0]['last_transaction_unit_price'],
                 'price_at' => now()
            ];
        });
    }
}
