<?php

namespace App\Http\Controllers\Super;

use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Intervention\Image\Facades\Image;

class ProfileController extends Controller
{
    public function showProfile(){
        $user = auth()->user();
        $data = DB::table('users')->where('users.email',$user->email)
            ->first();


        return view('super.profile.profile',[
            'info'=>$data,
        ]);
    }
    public function updateProfile(Request $request){
        $user = auth()->user();
        $validator = Validator::make($request->all(), [
            'email'=>'unique:users,email,'.$user->id,
            'gender'=>'required',
            'name'=>'required',
            'avatar'=>'image'
        ]);
        $validator->customValues = ['dob'=>$request['dob']];
        $validator->after(function($validator){
            if($this->validateDeadline($validator->customValues['dob'])){
                $validator->errors()->add('dob','The date of birth is Invalid');
            }
        });
        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }
        if($request->hasFile('avatar')){
            $profile  = $request->file('avatar');
            $filename = time().$profile->getClientOriginalName();
            Image::make($profile)->resize(300,300)
                ->save( public_path('img\\profile\\' . $filename));
        }else{
            $filename = $user->avatar;
        }
        DB::table('users')->where('id',$user->id)
            ->update([
                'email'=>$request->email,
                'dob'=>$request->dob,
                'gender'=>$request->gender,
                'name'=>$request->name,
                'religion'=>$request->religion,
                'avatar'=>$filename
            ]);
        DB::table('contacts')->where('user_id',$user->id)
            ->update([
                'address'=>$request->c_address,
                'alt_address'=>$request->c_address1,
                'contact'=>$request->c_phone,
                'alt_phone'=>$request->c_phone1
            ]);
        DB::table('academic_infos')->where('user_id',$user->id)
            ->update([
                'degree'=>$request->degree,
                'university'=>$request->uni,
                'year'=>$request->year
            ]);
        return redirect()->back()->with([
            'success'=>'Profile Updated Successfully'
        ]);
    }
    protected function validateDeadline($deadline){
        $deadline = Carbon::parse($deadline);
        $now = Carbon::now();
        if($now->gte($deadline))
            return false;
        return true;
    }
    public function showPassword(){
        return view('super.profile.password');
    }
    public function updatePassword(Request $request){
        $user = auth()->user();
        $validator = Validator::make($request->all(), [
            'password'=>'required',
            'newpass'=>'required|min:6|confirmed',
        ]);
        $validator->customValues = ['password'=>$request['password'],'old'=>$user->password];
        $validator->after(function($validator){
            if(!Hash::check($validator->customValues['password'],$validator->customValues['old'])){
                $validator->errors()->add('password','Incorrect Password');
            }
        });
        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        DB::table('users')->where('id',$user->id)
            ->update([
                'password'=>bcrypt($request->newpass)
            ]);
        return redirect()->back()->with([
            'success'=>'Password Updated Successfully'
        ]);
    }
}
