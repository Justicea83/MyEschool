<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Contact;
use App\Models\AcademicInfo;
use App\Models\Teacher;
use App\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Role;

class TeacherController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = Teacher::where('school_id',auth()->user()->school_id)
            ->select(['fname','lname','email','contact'])
            ->get();
        return view('admin.teachers.index',[
            'teachers'=>$data
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.teachers.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        if($request->ajax()){
            $this->validate($request,[

            ]);
            $teacher = new Teacher();
            $contact = new Contact();
            $academics = new AcademicInfo();
            $user = new User();
            //insert users
            $user->name = $request['firstname'].' '.$request['lastname'];
            $user->email = $request['email'];
            $user->password = bcrypt('password');
            $user->school_id = Auth::user()->school_id;
            $admin = Role::where('school_id',auth()->user()->school_id)
                ->where('name','teacher')->first();
            $user->role_id = $admin->id;
            $user->save();
            $user->attachRole($admin);
            $current = User::orderby('created_at','DESC')->pluck('id')->first();
            //contact info
            $contact->address = $request['c_address'];
            $contact->alt_address = $request['c_address1'];
            $contact->contact = $request['c_phone'];
            $contact->alt_phone = $request['c_phone1'];
            $contact->user_id = $current;
            $contact->state = $request['state'];
            $contact->zip = $request['zip'];
            $contact->email = $request['c_mail'];
            $contact->save();

            //acdemics info
            $academics->degree = $request['degree'];
            $academics->university = $request->uni['name'];
            $academics->user_id = $current;
            $academics->year = $request['year'];
            $academics->gpa = $request['gpa'];
            $academics->save();

            //teacher info

            $currentContact = Contact::orderby('created_at','DESC')->pluck('id')->first();
            $currentAcademic = AcademicInfo::orderby('created_at','DESC')->pluck('id')->first();
            $teacher->fname = $request['firstname'];
            $teacher->mname = $request['middlename'];
            $teacher->lname = $request['lastname'];
            $teacher->gender = $request['gender'];
            $teacher->dob = $request['dob'];
            $teacher->contact = $request['phone'];
            $teacher->user_id = $current;

            $teacher->contact_id = $currentContact;
            $teacher->academic_info_id = $currentAcademic;
            $teacher->school_id = Auth::user()->school_id;
            $teacher->email = $request['email'];
            $teacher->religion = $request['religion'];

            if($teacher->save()){
                return response()->json([
                    'message'=>'successfully added'
                ]);
            }

        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
