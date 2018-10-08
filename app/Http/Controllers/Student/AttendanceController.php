<?php

namespace App\Http\Controllers\Student;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AttendanceController extends Controller
{
    public function showSummary(){
        return view('students.attendance.summary');
    }
    public function showDetailed(){
        return view('students.attendance.detailed');
    }
}
