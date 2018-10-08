<?php

namespace App\Http\Controllers\Teacher;

use App\Models\Course;
use App\Models\NewClass;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AssignmentController extends Controller
{
    public function showCreate(){
        $classes = NewClass::where('school_id',auth()->user()->school_id)
            ->select('id','name')
            ->get();
        $courses = Course::where('school_id',auth()->user()->school_id)
            ->select('id','name')
            ->get();
        return view('teacher.assignment.create',[
            'classes'=>$classes,
            'courses'=>$courses
        ]);
    }
    public function showDownload(){
        return view('teacher.assignment.download');
    }
}
