<?php


namespace App\Http\Controllers\Admin;
use Illuminate\Http\Request;
//use Illuminate\Foundation\Validation\ValidatesRequests;
use App\Http\Controllers\Controller;
use App\Models\NewClass;
use App\Models\Course;
use App\Models\Teacher;
use App\Models\Timetable;
use App\Models\Slot;
use Yajra\DataTables\Facades\DataTables;
use DB;
class TimeTableController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */



    public function index()
    {
       $view_stage = NewClass::all();
        return view('admin.timetable.index',['view_stage'=>$view_stage]);

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
      $data =  DB::table('timetables')
      ->where('timetables.school_id',auth()->user()->school_id)
       ->leftJoin('teachers','timetables.teacher','teachers.id')
       ->leftJoin('courses', 'timetables.subject','courses.id')
       ->leftJoin('classes', 'timetables.stage', 'classes.id')
       ->select('timetables.*','teachers.fname as teacher_fname','courses.name as course_name', 'classes.name as class_name',
       'teachers.lname as teacher_lname')
       ->get();


      $slot = Slot::all();
      $timetables = Timetable::all();
      $stage = NewClass::all();
      $calass = NewClass::all();
      $courses = Course::all();
      $courso = Course::all();
      $teachers = Teacher::all();
      $teachor = Teacher::all();
        return view('admin.timetable.create',[
          'teachers'=>$teachers,
          'courses'=>$courses,
          'stage'=>$stage,
          'timetables'=>$timetables,
          'calass'=>$calass,
          'teachor'=> $teachor,
          'courso'=>$courso,
          'data'=>$data,
          'slot'=>$slot
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
       $timetable = new Timetable;

       $timetable->day = $request->day;
       $timetable->subject = $request->subject;
       $timetable->slot = $request->slot;
       $timetable->teacher = $request->teacher;
       $timetable->stage = $request->stage;
       $timetable->room = $request->room;
       $timetable->school_id = auth()->user()->school_id;
       $timetable->save();


    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
/*
      $sdata =  DB::table('timetables')
      ->where('timetables.school_id',auth()->user()->school_id)
      ->where('timetables.stage',$id)
       ->leftJoin('teachers','timetables.teacher','teachers.id')
       ->leftJoin('courses', 'timetables.subject','courses.id')
       ->leftJoin('classes', 'timetables.stage', 'classes.id')
       ->select('timetables.*',
         'courses.*','teachers.*','classes.*')
       ->get();
       */

$sdata =  DB::table('slot')
->where('slot.school_id',auth()->user()->school_id)
->where('slot.class_id',$id)
->select('slot.period')
//->distinct()
// ->Join('timetables','slot.period','timetables.slot')
// ->select('slot.*','timetables.*')
 ->get();

  return $sdata;
      // return DataTables::of($sdata)

      //     ->make(true);


    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data = Timetable::find($id);

        return $data;

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
        $result = Timetable::where('id',$id)->delete();
        if($result)
        return redirect()->back()->with([
          'success'=>'Deleted Successfully'
        ]);

        return redirect()->back()->with([
          'error'=>'Failed to Delete'
        ]);
    }
}
