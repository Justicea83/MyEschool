<?php

namespace App\Http\Controllers\Teacher;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ReportController extends Controller
{
    public function showAttendance(){
        return view('teacher.report.attendance');
    }
    public function showMarks(){
        return view('teacher.report.marks');
    }
}
