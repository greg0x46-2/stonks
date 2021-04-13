<?php


namespace App\Services\Markets;


use App\Models\Asset;
use App\Models\Market;

abstract class MarketService
{
    protected $market;

    public function __construct(Market $market)
    {
        $this->market = $market;
    }

    abstract function summary(Asset $asset): array;
}
