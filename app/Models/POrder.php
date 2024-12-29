<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class POrder extends Model
{
    protected $fillable = [
        "user_id",
        "product_id",
        "quantity",
        "isDelivered",
        "delivery_date",
        "isPaid",
        "receipt_no"
    ];

    public function user(){
        return $this->belongsTo(User::class, "user_id","id");
    }

    public function product(){
        return $this->belongsTo(Product::class, "product_id","id");
    }
}
