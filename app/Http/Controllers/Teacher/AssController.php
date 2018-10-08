<?php

namespace App\Http\Controllers\Teacher;

use App\Models\Teacher;
use App\Models\Assignment;
use App\Models\TeacherAssignment;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class AssController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'class'=>'required',
            'course'=>'required',
            'deadline'=>'date|required',
            'ass_file'=>'required'
        ]);
        $validator->customValues = ['deadline'=>$request['deadline']];
        $validator->after(function($validator){
            if($this->validateDeadline($validator->customValues['deadline'])){
                $validator->errors()->add('deadline','The deadline is Invalid');
            }
        });
        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }
        try{

            $id = auth()->user()->id;
            $teacher_id = Teacher::where('user_id',$id)->pluck('id')->first();
            $assignment = new Assignment();
            $assignment->teacher_id = $teacher_id;
            $assignment->date = Carbon::now()->toDateString();
            $assignment->course_id = $request->course;
            $assignment->class_id = $request->class;
            $assignment->school_id = auth()->user()->school_id;
            $assignment->deadline = $request->deadline;
            $assignment->remarks = $request->remarks;
            $assignment->save();

            $current = Assignment::orderby('created_at','DESC')->pluck('id')->first();
            $allowedfileExtension=['pdf','jpg','png','docx'];

            $files = $request->file('ass_file');
            $counter = 0;
            foreach($files as $file){
                $extension = $file->getClientOriginalExtension();
                $check=in_array(strtolower($extension),$allowedfileExtension);
                if($check){
                    $counter++;
                    $path =$file->store('Assignments');
                    $ass_teacher = new TeacherAssignment();
                    $ass_teacher->school_id = auth()->user()->school_id;
                    $ass_teacher->assignment_id = $current;
                    $ass_teacher->teacher_id = $teacher_id;
                    $ass_teacher->file_loc = $path;
                    $ass_teacher->save();
                }
            }
            return redirect()
                ->back()
                ->with([
                    'success'=>'Assignment Created Successfully'
                ]);
        }catch(\Exception $e){
            return redirect()
                ->back()
                ->with([
                    'error'=>'Couldn\'t Create Assignment'
                ]);
        }

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    /**
     * @param $deadline
     * @return bool
     */
    protected function validateDeadline($deadline){
        $deadline = Carbon::parse($deadline);
        $now = Carbon::now();
        if($now->lte($deadline))
            return false;
        return true;
    }
}
