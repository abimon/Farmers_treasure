<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = [
        "name",
        "price",
        "units",
        "category",
        "description",
        "isAvailable",
        "discount",
        "cover",
        'sales'
    ];
}
