<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\Pivot;

class AssetWallet extends Pivot
{
    use HasFactory;

    protected $fillable = [
        'asset_id',
        'wallet_id',
        'amount',
        'avg_price'
    ];

    public function wallet()
    {
        return $this->belongsTo(Wallet::class);
    }

    public function asset()
    {
        return $this->belongsTo(Asset::class);
    }

}
