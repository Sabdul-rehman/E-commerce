<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $table = 'categories';
    protected $primaryKey = 'Cid';
    public $guarded = [];

    public function carts()
    {
        return $this->hasMany(Cart::class, 'Cid', 'Cid');
    }

    public function reviews()
    {
        return $this->hasMany(Review::class, 'product_id', 'Cid');
    }

    public function approvedReviews()
    {
        return $this->hasMany(Review::class, 'product_id', 'Cid')->where('status', 'approved');
    }

    
}
