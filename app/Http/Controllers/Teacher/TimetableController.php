<?php

namespace App\Http\Controllers\Teacher;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class TimetableController extends Controller
{
    public function showTimetable(){
        return view('teacher.timetable.timetable');
    }
}
