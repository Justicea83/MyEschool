<?php

namespace App\Http\Controllers\Accountant;

use App\Models\StudentFeePayment;
use App\Models\Term;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class TransactionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $now = Carbon::now();
        $today = $now->toDateString();
        $user = auth()->user();
        $data_today = DB::table('student_fee_payments')
            ->where('student_fee_payments.school_id',$user->school_id)
            ->leftJoin('classes','student_fee_payments.class_id','classes.id')
            ->leftJoin('students','student_fee_payments.student_id','students.id')
            ->leftJoin('users','student_fee_payments.user_id','users.id')
            ->whereDate('student_fee_payments.created_at',$today)
            ->select('student_fee_payments.*','classes.name','users.name as accountant'
                ,'students.fname','students.lname','students.mname')
            ->get();

        //weekly
        $weekStart = $now->startOfWeek()->toDateString();
        $weekEnd = $now->endOfWeek()->toDateString();
        $data_weekly = DB::table('student_fee_payments')
            ->where('student_fee_payments.school_id',$user->school_id)
            ->leftJoin('classes','student_fee_payments.class_id','classes.id')
            ->leftJoin('students','student_fee_payments.student_id','students.id')
            ->leftJoin('users','student_fee_payments.user_id','users.id')
            ->whereBetween('student_fee_payments.created_at',[$weekStart,$weekEnd])
            ->select('student_fee_payments.*','classes.name','users.name as accountant'
                ,'students.fname','students.lname','students.mname')
            ->get();
        //termly account report
        $activeTerm = Term::where('status','active')->pluck('id')->first();
        $data_termly = DB::table('student_fee_payments')
            ->where('student_fee_payments.school_id',$user->school_id)
            ->leftJoin('classes','student_fee_payments.class_id','classes.id')
            ->leftJoin('students','student_fee_payments.student_id','students.id')
            ->leftJoin('users','student_fee_payments.user_id','users.id')
            ->where('student_fee_payments.term_id',$activeTerm)
            ->select('student_fee_payments.*','classes.name','users.name as accountant'
                ,'students.fname','students.lname','students.mname')
            ->get();

        //years
        $year = $now->year;
        $data_yearly = DB::table('student_fee_payments')
            ->where('student_fee_payments.school_id',$user->school_id)
            ->leftJoin('classes','student_fee_payments.class_id','classes.id')
            ->leftJoin('students','student_fee_payments.student_id','students.id')
            ->leftJoin('users','student_fee_payments.user_id','users.id')
            ->whereYear('student_fee_payments.created_at',$year)
            ->select('student_fee_payments.*','classes.name','users.name as accountant'
                ,'students.fname','students.lname','students.mname')
            ->get();
        return view('accountants.transactions.index',[
            'today'=>$data_today,
            'weekly'=>$data_weekly,
            'termly'=>$data_termly,
            'yearly'=>$data_yearly
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user = auth()->user();
        $data = DB::table('student_fee_payments')
            ->where('student_fee_payments.school_id',$user->school_id)
            ->where('student_fee_payments.id',$id)
            ->leftJoin('classes','student_fee_payments.class_id','classes.id')
            ->leftJoin('terms','student_fee_payments.term_id','terms.id')
            ->leftJoin('academic_years','student_fee_payments.academic_year_id','academic_years.id')
            ->leftJoin('students','student_fee_payments.student_id','students.id')
            ->leftJoin('users','student_fee_payments.user_id','users.id')
            ->select('student_fee_payments.*','classes.name','users.name as accountant','academic_years.name as year_name'
                ,'students.fname','students.lname','students.mname',
                'terms.display_name')
            ->first();
        //dd($data);
        return view('accountants.transactions.details',[
            'item'=>$data
        ]);
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
