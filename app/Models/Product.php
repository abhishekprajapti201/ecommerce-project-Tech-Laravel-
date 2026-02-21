<?php

namespace App\Models;

use App\Models\CartItem;
use App\Models\Category;
use App\Models\Inventory;
use App\Models\OrderItem;
use App\Models\ProductVariant;
use App\Models\Review;
use App\Models\Tenant;
use Illuminate\Database\Eloquent\Model;

class Product extends Model {
    protected $fillable = [
        'tenant_id','category_id','name','slug','description','price','stock','image','brands','weight','dipper','meterials','warranty','create_by','discount','original_price'
    ];
    public function tenant() { return $this->belongsTo(Tenant::class); }
    public function category() { return $this->belongsTo(Category::class); }
    public function variants() { return $this->hasMany(ProductVariant::class); }
    public function inventories() { return $this->hasMany(Inventory::class); }
    public function reviews() { return $this->hasMany(Review::class); }
    public function orderItems() { return $this->hasMany(OrderItem::class); }
    public function cartItems() { return $this->hasMany(CartItem::class); }
}