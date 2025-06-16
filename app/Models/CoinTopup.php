<?php

namespace App\Models;

use App\Models\User;
use App\Models\CoinPackage;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class CoinTopup extends Model
{
    protected $fillable = ['user_id', 'coin_package_id','amount', 'payment_method', 'status'];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
     public function coinPackage()
    {
        return $this->belongsTo(CoinPackage::class);
    }
}
