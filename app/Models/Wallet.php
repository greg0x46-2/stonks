<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Wallet extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'market_id'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function market()
    {
        return $this->belongsTo(Market::class);
    }

    public function orders()
    {
        return $this->hasMany(Order::class);
    }

    public function assets()
    {
        return $this->belongsToMany(Asset::class);
    }

    public function asset($asset, $pivotColumns = null)
    {
        $assetId = $asset instanceof Asset ? $asset->id : $asset;

        if (
            !$this->assets()->where('asset_id', $assetId)->exists() ||
            $pivotColumns
        ) {
            $this->assets()
                ->syncWithoutDetaching($pivotColumns ? [$assetId => $pivotColumns] : [$assetId]);
        }

        return $this->assets()->where('asset_id', $assetId)
            ->withPivot('amount', 'avg_price')
            ->first();
    }

    public function updateWallet(Order $order)
    {
        $asset = $this->asset($order->asset_id);
        $metadata = [];

        if ($order->type == 'B') {
            $metadata['amount'] = $order->amount + $asset->pivot->amount;
            $metadata['avg_price'] = (($order->amount * $order->price) + ($asset->pivot->amount * $asset->pivot->avg_price)) / $metadata['amount'];
        } else {
            $metadata['amount'] = $asset->pivot->amount - $order->amount;
        }

        return $this->asset(
            $order->asset_id, $metadata);
    }
}
