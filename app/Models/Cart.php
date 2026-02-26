<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    protected $guarded = [];
    // App/Models/Cart.php
public function product()
{
    return $this->belongsTo(Category::class, 'Cid', 'Cid');
}

}
