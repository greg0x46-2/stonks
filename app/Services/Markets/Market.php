<?php


namespace App\Services\Markets;


use App\Models\Asset;

abstract class Market
{
    abstract function currency(): array;

    public function createSummary(Asset $asset)
    {
        dd($this->currency());
    }
}
