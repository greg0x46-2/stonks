<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Asset extends Model
{
    use HasFactory;

    protected $fillable = [
        'code',
        'type'
    ];

    public static function findByCode($code)
    {
        return Asset::where('code', strtoupper($code))->first();
    }
}
