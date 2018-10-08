<?php

namespace App\Http\Controllers\Teacher;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class MarkController extends Controller
{
    public function showView(){
        return view('teacher.marks.view');
    }
    public function showAdd(){
        return view('teacher.marks.add');
    }


}
