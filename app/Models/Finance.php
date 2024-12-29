<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Finance extends Model
{
    protected $fillable = [
        "user_id",
        "project_id",
        "type",
        "amount",
        "description"
    ];

    public function user(){
        return $this->belongsTo(User::class,'user_id','id');
    }

    public function project(){
        return $this->belongsTo(Project::class,'project_id','id');
    }
}