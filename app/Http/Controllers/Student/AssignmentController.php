<?php

namespace App\Http\Controllers\Student;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class AssignmentController extends Controller
{
    public function showUpload(){
        return view('students.assignment.upload');
    }
    public function showDownload(){
        $user = auth()->guard('students')->user();
        $data = DB::table('assignments')->where('school_id',$user->school_id)
            ->where('class_id',$user->class_id)
            ->select('date','deadline','id')
            ->distinct()
            ->get();
        $currentAssignments = [];
        foreach($data as $item){
            $now = \Carbon\Carbon::now();
            $deadline = \Carbon\Carbon::parse($item->deadline);
            if($now->lte($deadline))
                array_push($currentAssignments,$item);
        }
        //dd($currentAssignments);
        return view('students.assignment.download',[
            'assigments'=>$currentAssignments
        ]);
    }
    public function showAssDetails($date){
        $user = auth()->guard('students')->user();
        $data = DB::table('teacher_assignments')
            ->where('teacher_assignments.school_id',$user->school_id)
            ->where('teacher_assignments.assignment_id',$date)
            ->leftJoin('teachers','teacher_assignments.teacher_id','teachers.id')
            ->leftJoin('assignments','teacher_assignments.assignment_id','assignments.id')
            ->leftJoin('courses','assignments.course_id','courses.id')
            ->select('teacher_assignments.*','teachers.fname','teachers.lname',
                'courses.name','assignments.remarks','assignments.deadline')
            ->get();
       // dd($data);
        return view('students.assignment.detail',[
            'assignments'=>$data
        ]);
    }
    public function downloadAss($file){
        $user = auth()->guard('students')->user();
        $data = DB::table('teacher_assignments')
            ->where('teacher_assignments.school_id',$user->school_id)
            ->where('id',$file)
            ->pluck('file_loc')
            ->first();
        $items = explode('/',$data);
        return response()->download(storage_path().'\app\\Assignments\\'.$items[1]);
    }

}
