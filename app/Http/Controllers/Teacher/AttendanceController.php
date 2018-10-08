<?php

namespace App\Http\Controllers\Teacher;

use App\Models\Attendance;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class AttendanceController extends Controller
{
    public function attendanceInfo($id){
        $data = DB::table('attendances')->where('attendances.school_id',auth()->user()->school_id)
            ->where('attendances.date',$id)
            ->leftJoin('students','attendances.student_id','students.id')
            ->Join('classes','attendances.class_id','classes.id')
            ->select('students.fname','students.lname',
                'attendances.id','attendances.status',
                'attendances.remarks')
            ->get();
        return view('teacher.attendance.details',[
            'details'=>$data
        ]);
    }

    public function showMark(){
        $id = DB::table('teachers')->where('email',auth()->user()->email)->first();
        $data = DB::table('classes')->where('classes.teacher_id',$id->id)
            ->leftJoin('students','students.class_id','classes.id')
            ->select('students.id','students.fname','classes.id as class_id',
                'students.mname','students.lname','students.ref_no')
            ->get();
        //dd($data);
        $student_id = [];
        foreach($data as $key=>$item){
            array_push($student_id,$item->id);
        }
        $class_id = [];
        foreach($data as $key=>$item){
            array_push($class_id,$item->class_id);
        }
        return view('teacher.attendance.mark',[
            'students'=>$data,
            'studentId'=>json_encode($student_id),
            'classId'=>json_encode($class_id)
        ]);
    }

    public function markAttendance(Request $request){
        $now = Carbon::now()->toDateString();
        $data = json_decode($request->student);
        $class = json_decode($request->class);
        try{
            foreach($data as $key=>$value){
                $attend = new Attendance();
                $attend->school_id = auth()->user()->school_id;
                $attend->date = $now;
                $attend->status = $request->status[$key];
                $attend->remarks = $request->remarks[$key];
                $attend->student_id = $value;
                $attend->teacher_id = auth()->user()->id;
                $attend->class_id = $class[$key];
                $data = DB::table('attendances')->where('school_id',auth()->user()->school_id)
                    ->where('student_id',$value)
                    ->where('date',$now)
                    ->first();
                if(isset($data)){
                    DB::table('attendances')->where('school_id',auth()->user()->school_id)
                        ->where('student_id',$value)
                        ->where('date',$now)
                        ->update([
                            'school_id'=>auth()->user()->school_id,
                            'date'=>$now,
                            'status'=>$request->status[$key],
                            'remarks'=>$request->remarks[$key],
                            'student_id'=>$value,
                            'class_id'=>$class[$key],
                            'teacher_id'=>auth()->user()->id
                        ]);
                    continue;
                }
                $attend->save();
            }
            return redirect()->back()->with([
                'success'=>'Attendance Saved Successfully'
            ]);
        }catch (\Exception $e){
            return redirect()->back()->with([
                'error'=>'Attendance Info Could\'nt be Saved'
            ]);
        }
    }
    public function showView(){
        $data = DB::table('attendances')->where('school_id',auth()->user()->school_id)
            ->select('date')
            ->distinct()
            ->get();
        return view('teacher.attendance.view',[
            'dates'=>$data
        ]);
    }

    public function showAttendanceInfo($id){
        $data = DB::table('attendances')->where('attendances.id',$id)
            ->leftJoin('students','attendances.student_id','students.id')
            ->select('students.fname','students.lname',
                'attendances.id','attendances.status',
                'attendances.remarks')
            ->first();
        return response()->json($data);
    }

    public function updateAttendanceInfo(Request $request){
        if($request->ajax()){
            DB::table('attendances')->where('id',$request->id)
                ->update([
                    'status'=>$request->status,
                    'remarks'=>$request->remarks
                ]);
        }
    }


}
