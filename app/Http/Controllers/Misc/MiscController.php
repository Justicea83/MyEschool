<?php

namespace App\Http\Controllers\Misc;

use App\Models\VerifyUser;
use App\Permission;
use App\Role;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\School;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Webpatser\Uuid\Uuid;
use Illuminate\Support\Facades\Auth;
use App\User;

class MiscController extends Controller
{
    public function regSchool(Request $request){
        if($request->ajax()){

          try{
              $school = new School();
              $school->email = $request->email;
              $school->contact = $request->contact;
              $school->alt_contact = $request->alt_contact;
              $school->name = $request->name;
              $school->location = $request->location;
              $temp = $school->id = (string) Uuid::generate();

              //
              //create roles for the schools and attach roles

              $role_names = ['admin','accountant','guardian','teacher','student'];
              foreach ($role_names as $name){
                  DB::table('roles')->insert([
                      'name'=>$name,
                      'school_id'=> $temp,
                      'display_name'=>title_case($name)
                  ]);
              }
              $permissions = Permission::all();

              $role = Role::where('school_id',$temp)
                  ->where('name', 'admin')->firstOrFail();
              $role->perms()->sync(
                  $permissions->pluck('id')->all()
              );
              //
              $admin = Role::where('school_id',$temp)
                  ->where('name','admin')->first();
              $user = new User();
              try{
                  $user->name =  $request->username;
                  $user->password = bcrypt($request->password);
                  $user->email = $request->user_mail;
                  $user->school_id = $temp;
                  $user->role_id = $admin->id;
                  $user_save = $user->save();
              }catch (\Exception $e){
                  return response()->json([
                      'status'=>'error',
                      'message'=>'A user with the same email already exists'
                  ]);
              }

              $user->attachRole($admin);
              $verifyUser = VerifyUser::create([
                  'user_id' => $user->id,
                  'token' => str_random(40)
              ]);
              try{
                  Mail::to($user->email)->send(new \App\Mail\VerfiyUser($user));
              }catch (\Exception $e){
                  return response()->json([
                      'status'=>'error',
                      'message'=>'email couldn\'t be sent pls contact the administrator'
                  ]);
              }
              if($school->save() && $user_save )
                  return response()->json([
                      'status'=>'success',
                      'message'=>'Successfully registered'
                  ]);
          }catch (\Exception $e){
              return response()->json([
                  'status'=>'error',
                  'message'=>'An Error Occurred'
              ]);
          }


        }

    }

    public function login(Request $request){
        if($request->ajax()){
            Auth::logout();
           try{
               $url = null;
               if($request['format'] == 'admin') {
                   if (Auth::attempt(['email' => $request['email'], 'password' => $request['password']]
                       , $request['remember'])) {
                       if(\auth()->user()->verified == 0){
                           \auth()->logout();
                           return response()->json([
                               'status'=>'unverified',
                               'message'=>'Email Not Verified'
                           ]);
                       }else{
                           $role = User::where('email', $request['email'])->pluck('role_id')->first();
                           $url = '/' . Role::where('id', $role)->pluck('name')->first();
                       }
                   }
               }else{
                   if(Auth::guard('students')
                       ->attempt(['username'=>$request['username'],'password'=>$request['password']],
                           $request['remember'])){
                       auth()->shouldUse('students');
                      $url = '/student';
                   }
               }
                   if($url != null){
                       return response()->json([
                           'status'=>'success',
                           'url'=>$url
                       ]);
                   }
                   return response()->json([
                       'status'=>'error',
                   ]);

           }catch(\Exception $e){
               return response()->json([
                   'status'=>'error',
               ]);
           }
        }
    }

    public function logout(){
        $data = array_keys(config('auth.guards'));
        foreach($data as $item){
            if(auth()->guard($item)->check())
                Auth::guard($item)->logout();
        }
        return redirect('/');
    }

    /**
     * @param $token
     * @return \Illuminate\Http\RedirectResponse
     */
    public function verifyUser($token)
    {
        $verifyUser = VerifyUser::where('token', $token)->first();
        if(isset($verifyUser) ){
            $user = $verifyUser->user;
            if(!$user->verified) {
                $verifyUser->user->verified = 1;
                $verifyUser->user->save();
                $status = "Your e-mail is verified. You can now login.";
            }else{
                $status = "Your e-mail is already verified. You can now login.";
            }
        }else{
            return redirect('/login')->with('error', "Sorry your email cannot be identified.");
        }

        return redirect('/login')->with('success', $status);
    }
}
