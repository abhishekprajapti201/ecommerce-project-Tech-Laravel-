<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class WishList extends Model
{
    protected $primaryKey = 'id';
    protected $table = 'whislists';
    protected $fillable = ['user_id','product_id'];
}