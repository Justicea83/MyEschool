<?php

namespace App\Http\Controllers\Admin;

use App\Models\ClassCourse;
use App\Models\Course;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CourseController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.general_course.create');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.general_course.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if($request->ajax()){
            try{
                $now = Carbon::now();
                $course = new Course();
                //$class_course = new ClassCourse();
                //populate with data
                $course->name = $request->name;
                $course->code = $request->code;
                $course->year = $now->year;
                $course->school_id = auth()->user()->school_id;
                $course->save();

                /*$currentCourse = Course::orderby('created_at','DESC')->pluck('id')->first();
                $class_course->class_id = $request->class_id;
                $class_course->teacher_id = $request->teacher_id;
                $class_course->school_id = auth()->user()->school_id;
                $class_course->course_id = $currentCourse;
                $class_course->save();*/
                return response()->json([
                    'status'=>'success'
                ]);
            }catch (\Exception $e){
                return response()->json([
                    'status'=>'error'
                ]);
            }
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
}
