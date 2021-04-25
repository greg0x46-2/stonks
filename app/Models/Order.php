<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'asset_id',
        'wallet_id',
        'type',
        'executed_at',
        'amount',
        'price',
        'fee_percentage',
        'fee'
    ];

    public function asset()
    {
        return $this->belongsTo(Asset::class);
    }

    public function wallet()
    {
        return $this->belongsTo(Wallet::class);
    }
}
