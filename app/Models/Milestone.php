<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Milestone extends Model
{
    //
    protected $fillable = [
        "project_id",
        "title",
        "description",
        "progress",
        "expected_completion_date",
        "actual_completion_date",
        "created_by",
        "budget"
    ];

    public function project(){
        return $this->belongsTo(Project::class, "project_id",'id');
    }
    public function user(){
        return $this->belongsTo(User::class, "created_by",'id');
    }
}
