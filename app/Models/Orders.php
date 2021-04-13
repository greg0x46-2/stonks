<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Orders extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'asset_id',
        'market_id',
        'type',
        'executed_at',
        'amount',
        'price',
        'fee_percentage',
        'fee'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function asset()
    {
        return $this->belongsTo(Asset::class);
    }

    public function market()
    {
        return $this->belongsTo(Market::class);
    }
}
