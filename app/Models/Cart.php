<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    protected $fillable = [
        "user_id",
        "product_id",
        "quantity"
    ];

    public function item(){
        return $this->belongsTo(Product::class,"product_id","id");
    }
    public function user(){
        return $this->belongsTo(User::class,"user_id","id");
    }
}
