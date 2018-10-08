<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    public function classes(){
        return $this->belongsToMany(NewClass::class,'class_courses');
    }
}
