<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AssetSummary extends Model
{
    use HasFactory;

    protected $fillable = [
        'asset_id',
        'market_id',
        'pair',
        'price',
        'price_at',
        'volume',
        'max_price',
        'min_price'
    ];

    protected $dates = [
        'price_at'
    ];
}
