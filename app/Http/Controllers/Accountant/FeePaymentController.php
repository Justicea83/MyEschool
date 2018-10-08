<?php

namespace App\Http\Controllers\Accountant;

use App\Models\StudentFeePayment;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class FeePaymentController extends Controller
{
    public function saveFees(Request $request){
        if($request->ajax()){
            try{

                $fees = new StudentFeePayment();
                $fees->class_id = $request->class_id;
                $fees->student_id = $request->student_id;
                $fees->school_id = auth()->user()->school_id;
                $fees->bank_name = $request->bank_name;
                $fees->cheque_no = $request->cheque_no;
                $fees->branch = $request->branch;
                $fees->cheque_date = $request->cheque_date;
                $fees->amount = $request->amount;
                $fees->balance = $request->balance;
                $fees->previous = $request->balance;
                $fees->remarks = $request->remarks;
                $fees->amount_payable = $request->amount_payable;
                $fees->academic_year_id = $request->academic_id;
                $fees->payment_mode = $request->payment_mode;
                $fees->user_id = auth()->user()->id;
                $fees->date = Carbon::now()->toDateString();
                $fees->term_id = $request->term_id;
                if($fees->save())
                return response()->json([
                    'message'=>'Fees Saved successfully',
                    'status'=>'success'
                ]);
            }catch (\Exception $e){
                return response()->json([
                    'message'=>'Sorry an Error Occured',
                    'status'=>'error'
                ]);
            }
        }
    }
}

