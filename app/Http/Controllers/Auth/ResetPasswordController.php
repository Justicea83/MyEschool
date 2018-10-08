<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use App\User;
use App\Role;
use Illuminate\Support\Facades\Auth;
class ResetPasswordController extends Controller
{
    public function showResetForm(){
        return view('passwords.reset');
    }
    public function reset(Request $request){
        if($request->ajax()){
            $url = '';
            Auth::logout();
            $token = $request->token;
            $email = DB::table('password_resets')->
                where('token',$token)->pluck('email')->first();
            DB::table('users')->where('email',$email)->update([
                'password'=>bcrypt($request->password)
            ]);
            $user =  User::where('email',$email)->first();
            $role = $user->role_id;
            $url = '/'.Role::where('id',$role)->pluck('name')->first();
            if($url != '')
                Auth::login($user);
            return $url;
        }
    }
}
