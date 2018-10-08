<?php

namespace App\Http\Controllers\Admin;

use App\Models\AcademicInfo;
use App\Models\Student;
use App\Models\NewClass;
use App\Models\NewParent;
use App\Models\StudentAcademicInfo;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Role;
use App\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class StudentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = DB::table('students')->where('students.school_id',auth()->user()->school_id)
            ->leftJoin('classes','students.class_id','classes.id')
            ->leftJoin('parents','students.parent_id','parents.id')
            ->leftJoin('student_academic_infos','students.student_academic_info_id','student_academic_infos.id')
            ->select('students.*','classes.name as class_name','parents.contact as parent_contact',
                'parents.email as parent_email','student_academic_infos.reg_number as reg_no')
            ->get();
        return view('admin.student.index',[
            'data'=>$data
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $classes = NewClass::where('school_id',auth()->user()->school_id)->get();
        $countries = file_get_contents(public_path('files/countries.json'));
        $nationalities = file_get_contents(public_path('files/nationality.json'));
        $occupations = file_get_contents(public_path('files/occupations.json'));
        return view('admin.student.create',[
            'countries'=>json_decode($countries),
            'nationalities'=>json_decode($nationalities),
            'occupations'=>json_decode($occupations),
            'classes'=>$classes
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $this->validate($request,[
            'email'=>'email|required|unique:parents|unique:users,email',
        ]);

        try{
            //parent data
            $admin = Role::where('school_id',auth()->user()->school_id)
                ->where('name','guardian')->first();
            $admin_stud = Role::where('school_id',auth()->user()->school_id)
                ->where('name','student')->first();
            $parent = new NewParent();
            $parent->school_id = auth()->user()->school_id;
            $parent->fname =$request->father_name;
            $parent->mname = $request->mother_name;
            $parent->occupation = $request->occupation;
            $parent->contact = $request->contact;
            $parent->alt_contact = $request->alt_contact;
            $parent->religion = $request->p_religion;
            $parent->email = $request->email;
            $parent->nationality = $request->p_nationality;
            $parent->address  = $request->address;
            $parent->country = $request->country;
            $parent->save();


            //insert parent to users table
            $user = new User();
            //insert users
            $user->name = $request->father_name;
            $user->email = $request['email'];
            $user->password = bcrypt('password');
            $user->school_id = Auth::user()->school_id ? Auth::user()->school_id: 0;
            $user->role_id = $admin->id;
            $user->save();
            $user->attachRole($admin);

            //
            $currentParent = NewParent::orderby('created_at','DESC')->pluck('id')->first();

        //academic info data
        $info = new StudentAcademicInfo();
        $info->school_id = auth()->user()->school_id;
        $info->class_id = $request->s_class;
        $info->last_school = $request->last_sch;
        $info->roll = $request->roll_no;
        $info->reg_number = $request->reg_number;
        $info->sports = $request->sports;
            //current info
        $currentInfo = AcademicInfo::orderby('created_at','DESC')->pluck('id')->first();

            //student data
            $student = new Student();
            $tempFirstName = $student->fname = $request->fname;
            $student->mname = $request->mname;
            $tempLastName = $student->lname = $request->lname;
            $student->school_id = auth()->user()->school_id;
            $student->email = $request->student_email;
            $student->username = $tempFirstName.'.'.$tempLastName.str_random(5);
            $student->ref_no = uniqid('MYE');
            $student->role_id = $admin_stud->id;
            $student->birth_date = $request->dob;
            $student->gender = $request->gender;
            $student->class_id = $request->s_class;
            $student->religion = $request->s_religion;
            $student->student_academic_info_id =$currentInfo;
            $student->password =bcrypt('password');
            $student->name =$tempFirstName.' '.$request->lname;
            $student->parent_id = $currentParent;
            $student->save();

            //how do u login a student??

            if($info->save()){
                return redirect()
                    ->route('admin.student.receipt.print')
                    ->with([
                    'success'=>'Student Added Successfully',
                ]);
            }
            return redirect()->back()->with([
                'error' => 'An Error Occured'
            ]);

        }catch (\Exception $e){
            return redirect()->back()->with([
                'error' => 'An Error Occured'
            ]);
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
        $info = DB::table('students')->where('id',$id)->pluck('student_academic_info_id')->first();
        DB::table('students')->where('id',$id)->delete();
        DB::table('student_academic_infos')->where('id',$info)->delete();
        return redirect()->back()->with([
            'success'=>'Deleted Successfully'
        ]);
    }
}
