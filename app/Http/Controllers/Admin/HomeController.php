<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Models\Teacher;
use App\Models\Student;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use App\Models\Term;
use App\Models\AcademicYear;
use App\Http\Controllers\Controller;

class HomeController extends Controller
{
    public function home(){
        $student_count = Student::where('school_id',auth()->user()->school_id)->count();
        $teachers_count = Teacher::where('school_id',auth()->user()->school_id)->count();
        $user = auth()->user();
        //get amounts
        $now = Carbon::now();
        $today = $now->toDateString();
        $today_amount = DB::table('student_fee_payments')
            ->where('student_fee_payments.school_id',$user->school_id)
            ->where('user_id',$user->id)
            ->whereDate('student_fee_payments.created_at',$today)
            ->sum('amount');
        $activeTerm = Term::where('status','active')->pluck('id')->first();
        $term_amount = DB::table('student_fee_payments')
            ->where('school_id',$user->school_id)
            ->where('user_id',$user->id)
            ->where('term_id',$activeTerm)
            ->sum('amount');
        return view('admin.main',[
            'student_count'=>$student_count,
            'teacher_count'=>$teachers_count,
            'today_amount'=>$today_amount,
            'term_amount'=>$term_amount
        ]);
    }
}
