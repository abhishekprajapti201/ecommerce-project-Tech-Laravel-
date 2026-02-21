<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Coupon extends Model {
    protected $fillable = ['code','type','value','min_purchase','expires_at','max_usage','usage_count'];

    public function orders() { return $this->hasMany(Order::class); }
}

