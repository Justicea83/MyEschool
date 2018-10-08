<?php

namespace App\Http\Controllers\Student;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ExamController extends Controller
{
    public function showPlan(){
        return view('students.examination.plan');
    }
    public function showSchedule(){
        return view('students.examination.schedule');
    }
}
