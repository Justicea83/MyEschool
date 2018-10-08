<?php

namespace App\Http\Controllers\Misc;

use App\Models\AcademicYear;
use App\Models\Fee;
use App\Models\Item;
use App\Models\NewClass;
use App\Models\StudentFeePayment;
use App\Models\Term;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Teacher;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Facades\DataTables;
class EndPointController extends Controller
{
    //teachers and classes
    public function names(){
        return Teacher::select('id','fname','lname')
            ->where('school_id',auth()->user()->school_id)
            ->get();
    }
    public function teacherClass(){
        $data= DB::table('classes')->where('classes.school_id',auth()->user()->school_id)
            ->leftJoin('teachers','classes.teacher_id','teachers.id')
            ->select('classes.*','teachers.fname','teachers.lname')
            ->get();
        return DataTables::of($data)
            ->setRowId(function ($data) {
                return $data->id;
            })
            ->addColumn('fname', function($row){
                return $row->fname.' '.$row->lname;
            })
            ->make(true);
    }
    //exposing items
    public function items(){
         $data = DB::table('items')->where('items.school_id',auth()->user()->school_id)
             ->leftJoin('academic_years','items.academic_year_id','academic_years.id')
             ->leftJoin('terms','items.term_id','terms.id')
             ->select('items.*','academic_years.name as academic','terms.display_name as term')
             ->get();
        return DataTables::of($data)
            ->make(true);
    }
    public function generateYears(){
        $now = Carbon::now();
        $year = $now->year;
        $years =[];
        for($i = 0 ; $i < 10 ; $i++){
            array_push($years,['current'=>$year-1,'one'=>$year]);
            $year++;
        }
        return $years;
    }

    public function showAcademicYears(){
        $data = AcademicYear::where('school_id',auth()->user()->school_id)->get();
        return DataTables::of($data)
            ->make(true);
    }

    public function showFromYearsTable(){
        $data= AcademicYear::where('school_id',auth()->user()->school_id)->get();
        return $data;
    }

    public function makeDataTableTerms(){
        //$data = Term::where('school_id',auth()->user()->school_id)->get();
        $data = DB::table('terms')->where('terms.school_id',auth()->user()->school_id)
            ->leftJoin('academic_years','terms.academic_year_id','academic_years.id')
            ->select('terms.*','academic_years.name as academic')
            ->get();
        return DataTables::of($data)
            ->make(true);
    }
//working here
    public function showTerms($name){
        $data = DB::table('terms')->where('school_id',auth()->user()->school_id)
            ->where('academic_year_id',$name)
            ->orderBy('status','ASC')
            ->get();
        return $data;
    }

    public function showAllClasses(){
        return NewClass::where('school_id',auth()->user()->school_id)->get();
    }

    public function showAllItems(){
        $data = DB::table('items')->where('items.school_id',auth()->user()->school_id)
            ->leftJoin('academic_years','items.academic_year_id','academic_years.id')
            ->leftJoin('terms','items.term_id','terms.id')
            ->select('items.*','academic_years.name as academic','terms.display_name as term')
            ->get();
        return $data;
    }

    //returning school fees
    public function feesDistinctClass(){
        $data = DB::table('fees')
            ->where('fees.school_id',auth()->user()->school_id)
            ->select('fees.class_id')
            ->distinct()
            ->leftJoin('classes','fees.class_id','classes.id')
            ->select('fees.class_id','classes.name as class_name')
            ->get();
        return DataTables::of($data)
            ->make(true);
    }

    public function allCourses(){
        $data = DB::table('courses')->where('school_id',auth()->user()->school_id)
            ->get();
        return DataTables::of($data)
            ->make(true);
    }

    public function allClassCourses(){
        $data = DB::table('class_courses')->where('class_courses.school_id',auth()->user()->school_id)
            ->leftJoin('classes','class_courses.class_id','classes.id')
            ->leftJoin('teachers','class_courses.teacher_id','teachers.id')
            ->leftJoin('courses','class_courses.course_id','courses.id')
            ->select('class_courses.id','classes.name as class_name',
                'teachers.fname','teachers.lname'
                ,'courses.name as course_name','courses.code as code'
            )
            ->get();
        return DataTables::of($data)
            ->make(true);
    }
    public function showParents(){
        $data = DB::table('parents')->where('parents.school_id',auth()->user()->school_id)
            ->leftJoin('schools','parents.school_id','schools.id')
            ->select('parents.fname','parents.contact','parents.email','schools.name')
            ->get();
        return $data;
    }
    //accountant section starts from here
    public function showParticularStudent($id){
        $user = auth()->user();
        $activeYear = AcademicYear::where('status','active')->pluck('id')->first();
        $activeTerm = Term::where('academic_year_id',$activeYear)
            ->where('status','active')
            ->pluck('id')
            ->first();
        $getBreakdown = Fee::where('term_id',$activeTerm)
            ->where('academic_year_id',$activeYear)
            ->where('class_id',$id)
            ->pluck('item_id');
        $fees = 0;
       foreach ($getBreakdown as $item){
           $temp = Item::where('id',$item)->pluck('amount')->first();
           $fees += $temp;
       }
        $data = DB::table('students')
            ->where('students.school_id',$user->school_id)
            ->where('students.class_id',$id)
            ->select('students.id','students.mname','students.lname','students.fname')
            ->get();
        $data =  DataTables::of($data)
            ->addColumn('fullname', function($row){
                return $row->fname.' '.$row->mname.' '.$row->lname;
            })
            ->make(true);

        return response()->json([
            'data'=>$data,
            'amount'=>$fees,
            'academic'=>$activeYear,
            'term'=>$activeTerm
        ]);
    }

    public function showStudentPrevious($id){
        $user = auth()->user();
        $activeYear = AcademicYear::where('status','active')->pluck('id')->first();
        $activeTerm = Term::where('academic_year_id',$activeYear)
            ->where('status','active')
            ->pluck('id')
            ->first();
        $previousChecks = StudentFeePayment::where('school_id',auth()->user()->school_id)
            ->where('student_id',$id)
            ->where('term_id','<>',$activeTerm)
            //->where('academic_year_id','<>',$activeYear)
            ->orderby('created_at','DESC')
            ->pluck('balance')
            ->first();
            //->get();
        //dd($previousChecks);
        $checks = StudentFeePayment::where('school_id',auth()->user()->school_id)
            ->where('student_id',$id)
            ->where('term_id',$activeTerm)
            ->where('academic_year_id',$activeYear)
            ->orderby('created_at','DESC')
            ->pluck('balance')
            ->first();
        if(isset($checks)){
            return response()->json([
                'data'=>$checks,
                'status'=>'some'
            ]);
        }else if (isset($previousChecks)){
            return response()->json([
                'data'=>$previousChecks,
                'status'=>'pre'
            ]);
        }else{
            return 0;
        }

    }
    public function getAllUniversities(){
        $uni = file_get_contents(public_path('files/uni.json'));
        $uni = json_decode($uni);
        return $uni;
    }
    public function allYearsPassed(){
        $now = Carbon::now()->year;
        $year = [];
        for($i = 1960 ; $i <= $now ; $i++){
            array_push($year,['yname'=>$i]);
        }

        return $year;
    }

}
