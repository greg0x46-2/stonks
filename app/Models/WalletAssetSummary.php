<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WalletAssetSummary extends Model
{
    use HasFactory;

    protected $fillable = [
        'wallet_asset_id',
        'date',
        'avg_price',
        'amount',
        'result'
    ];
}
