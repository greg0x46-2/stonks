<?php

namespace App\Models;

use App\Services\Markets\BitcoinTradeService;
use App\Services\Markets\MarketService;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Market extends Model
{
    use HasFactory;

    protected $fillable = [
        'name'
    ];

    public function assets()
    {
        return $this->belongsToMany(Asset::class);
    }

    public function service(): ?MarketService
    {
        switch ($this->name) {
            case 'Bitcoin Trade':
                return new BitcoinTradeService($this);
        }

        return null;
    }
}
