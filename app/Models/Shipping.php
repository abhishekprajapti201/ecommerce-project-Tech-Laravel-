<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Shipping extends Model {
    protected $fillable = ['order_id','courier_name','tracking_number','shipped_at','delivered_at','status'];

    public function order() { return $this->belongsTo(Order::class); }
}

