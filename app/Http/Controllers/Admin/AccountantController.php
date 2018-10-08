<?php
namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Accountant;
use App\Models\Contact;
use App\Models\AcademicInfo;
use App\Role;
use App\User;
use Carbon\Carbon;

class AccountantController extends Controller
{
    public function home(){

        return view('accountants.main');

    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //     $data = Accountant::where('school_id',auth()->user()->school_id)
        //     ->select(['fname','lname','email','contact'])
        //     ->get();
        // return view('accountants.index',[
        //     'accountants'=>$data
        // ]);
        $accountants = Accountant::all();
        return view('accountants.index',compact('accountants'));
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('accountants.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

       try{
           //validation
           $this->validate($request,[
               'firstname'=>'required',
               'lastname'=>'required',
               'gender'=>'required',
               'dob'=>'required',
               'phone'=>'required',
               'c_address'=>'required',
               'c_phone'=>'required',
               'degree'=>'required',
               'uni'=>'required',
               'year'=>'required',
               'email'=>'email|required|unique:parents|unique:users,email',
               //   'c_mail'=>'email|required|unique:parents|unique:users,email',


           ]);
           $admin = Role::where('school_id',auth()->user()->school_id)->
           where('name','accountant')->first();

           $accountant = new Accountant();
           $contact = new Contact();
           $academics = new AcademicInfo();
           $user = new User();
           //insert users

           $user->name = $request['firstname'].' '.$request['middlename'].' '.$request['lastname'];
           $user->email = $request['email'];
           $user->password = bcrypt('password');
           $user->school_id = auth()->user()->school_id ;
           $user->role_id = $admin->id;
           $user->save();

           $user->attachRole($admin);
           $current = User::orderby('created_at','DESC')->pluck('id')->first();
           //contact info
           $contact->address = $request['c_address'];
           $contact->alt_address = $request['c_address1'];
           $contact->contact = $request['c_phone'];
           $contact->user_id = $current;
           $contact->alt_phone = $request['c_phone1'];
           $contact->state = $request['state'];
           $contact->zip = $request['zip'];
           $contact->email = $request['email'];
           $contact->save();

           //acdemics info
           $academics->degree = $request['degree'];
           $academics->university = $request['uni'];
           $academics->user_id = $current;
           $academics->year = $request['year'];
           $academics->gpa = $request['gpa'];
           $academics->save();
           $dob =  $request['dob'];

           $mydob= Carbon::createFromFormat('Y-m-d',$dob);
           //Accountant info
           $currentContact = Contact::orderby('created_at','DESC')->pluck('id')->first();
           $currentAcademic = AcademicInfo::orderby('created_at','DESC')->pluck('id')->first();
           $accountant->fname = $request['firstname'];
           $accountant->mname = $request['middlename'];
           $accountant->lname = $request['lastname'];
           $accountant->gender = $request['gender'];
           $accountant->dob = $mydob;
           $accountant->contact = '+233'.$request['phone'];
           $accountant->user_id =$current;
           $accountant->contact_id = $currentContact;
           $accountant->academic_info_id = $currentAcademic;
           $accountant->school_id = auth()->user()->school_id ;
           $accountant->email = $request['email'];
           $accountant->religion = $request['religion'];
           $accountant->save();
           return redirect()->back()->with([
               'success'=>'Accountant Added Successfully'
           ]);
       }catch (\Exception $e){
           return redirect()->back()->with([
               'error'=>'Accountant Couldn\'t be added'
           ]);
       }

    }
    // public function store(Request $request)
    // {

    // }

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
        //A
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
        // $accountant =Accountant::findOrFAil($id);
        // $accountant = delete();
        Accountant::destroy($id);
        return back();
    }
}
