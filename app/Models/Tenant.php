<?php

// model
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Tenant extends Model {
    protected $fillable = ['name','domain'];

    public function users() { return $this->hasMany(User::class); }
    public function categories() { return $this->hasMany(Category::class); }
    public function products() { return $this->hasMany(Product::class); }
}

