<?php

namespace App\Http\Controllers\Student;

use App\Models\Assignment;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class HomeController extends Controller
{
    public function home(){
        $data = Assignment::where('school_id',auth()->guard('students')->user()->school_id)
            ->where('class_id',auth()->guard('students')->user()->class_id)
            ->get();
        $assignments = 0;
        foreach ($data as $item){
            $now = \Carbon\Carbon::now();
            $deadline = \Carbon\Carbon::parse($item->deadline);
            if($now->lte($deadline))
                $assignments++;
        }
        return view('students.main',[
            'assignments'=>$assignments
        ]);
    }
}
