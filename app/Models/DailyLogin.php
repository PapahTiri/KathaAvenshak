<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DailyLogin extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'day', 'claimed_at'];
}
