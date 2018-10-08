<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ReportController extends Controller
{
    public function teacherAttendance(){
        return view('admin.reports.attendance');
    }

    public function teacherMarks(){
        return view('admin.reports.marks');
    }
}
