<?php

namespace App\Http\Controllers\Accountant;

use App\Models\Student;
use App\Models\Term;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    public function home(){
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
        return view('accountant.main',[
            'today_amount'=>$today_amount,
            'term_amount'=>$term_amount
        ]);
    }
    public function getFee(){
        $students = Student::all();
        return view('accountant.fees',['students'=>$students]);
    }
}
