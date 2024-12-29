<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    protected $fillable = [
        "name",
        "description",
        "deadline",
        "initiatedBy"
    ];

    public function user(){
        return $this->belongsTo(User::class, "initiatedBy",'id');
    }
    public function milestones(){
        return $this->hasMany(Milestone::class,'project_id','id');
    }
    public function finance(){
        return $this->hasMany(Finance::class,  'project_id','id');
    }
}

