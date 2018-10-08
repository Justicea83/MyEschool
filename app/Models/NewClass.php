<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class NewClass extends Model
{
    protected $table = 'classes';
    public function users()
    {
        return $this->belongsToMany(Course::class,'class_courses');
    }

    public function school(){
        return $this->belongsTo(School::class);
    }
}
