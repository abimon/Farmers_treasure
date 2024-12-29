<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $fillable = [
        'receipt_no', 
        'address', 
        'phone', 
        'name',
        'note',
        'email',
        'payment_mode'
    ];

    public function orderItems(){
        return $this->hasMany(POrder::class,'receipt_no','receipt_no');
    }
}
