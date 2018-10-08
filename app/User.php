<?php

namespace App;

use App\Models\VerifyUser;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Zizaco\Entrust\Traits\EntrustUserTrait;
use Illuminate\Support\Facades\Auth;
class User extends Authenticatable
{
    use Notifiable;
    use EntrustUserTrait;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function isSuper(){
        $role =Role::where('name','super')->first();
        return Auth::user()->role_id == $role->id;
    }
    public function isAdmin(){
        $role =Role::where('school_id',\auth()->user()->school_id)
            ->where('name','admin')->first();
        return Auth::user()->role_id == $role->id;
    }
    public function isStudent(){
        $role =Role::where('school_id',\auth()->user()->school_id)
            ->where('name','student')->first();
        return Auth::user()->role_id == $role->id;
    }
    public function isTeacher(){
        $role =Role::where('school_id',\auth()->user()->school_id)
            ->where('name','teacher')->first();
        return Auth::user()->role_id == $role->id;
    }
    public function isAccountant(){
        $role =Role::where('school_id',\auth()->user()->school_id)
            ->where('name','accountant')->first();
        return Auth::user()->role_id == $role->id;
    }
    public function isGuardian(){
        $role =Role::where('school_id',\auth()->user()->school_id)
            ->where('name','guardian')->first();
        return Auth::user()->role_id == $role->id;
    }
    public function verifyUser(){
        return $this->hasOne(VerifyUser::class);
    }
}
