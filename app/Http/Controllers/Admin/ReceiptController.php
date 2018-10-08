<?php

namespace App\Http\Controllers\Admin;

use App\Models\Student;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ReceiptController extends Controller
{
    public function printStudentReceipt(){
        $data = Student::orderby('created_at','DESC')
            ->select('fname','lname','mname','username')
            ->first();
        return view('admin.student.receipt',[
            'info'=>$data
        ]);
    }
}
