<?php

namespace App\Http\Controllers\Auth;

use App\Notifications\ResetPasswordNotification;
use App\services\UtilityService;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use App\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Notification;

class ForgotPasswordController extends Controller
{
    public function showLinkRequestForm(){
        return view('passwords.email');
    }

    public function sendResetLinkEmail(Request $request){
        $user = User::where('email', $request->email)->first();
        if($user != null){
            $token = UtilityService::generateRandomString();

            $userToken = DB::table('password_resets')->where('email', $request->email)->first();
            if ($userToken) {
                DB::table('password_resets')->where('email', $request->email)->update([
                    'token' => $token,
                ]);
            } else {
                DB::table('password_resets')->insert([
                    'email' => $user->email,
                    'token' => $token,
                ]);
            }
            Notification::send($user,new ResetPasswordNotification($token,$user));
            return response()->json([
                'message'=>'email has been sent successfully',
                'status'=>'success'
            ]);
        }
        return response()->json([
            'message'=>'Invalid User Email',
            'status'=>'error'
        ]);
    }
}
