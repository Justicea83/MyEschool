<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Student extends Authenticatable
{
    use Notifiable;
    protected $guard = "students";
    public function guardian(){
        return $this->belongsTo('App\Models\Parent');
    }

    public function region(){
        return $this->belongsTo(Religion::class);
    }

    public function role(){
        return $this->belongsTo(Role::class);
    }
}
