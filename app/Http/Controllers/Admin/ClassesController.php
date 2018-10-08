<?php

namespace App\Http\Controllers\Admin;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\NewClass;
use Illuminate\Support\Facades\Auth;
use Webpatser\Uuid\Uuid;
use Yajra\DataTables\Facades\DataTables;
class ClassesController extends Controller
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
        return view('admin.class.create');
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
            $class = new NewClass();
            $class->school_id = Auth::user()->school_id;
            $class->name = $request->name;
            $class->code = $request->code;
            $class->teacher_id = $request->teacher;
            $class->description = $request->description;
           if($class->save()){
               return response()->json([
                   'message'=>'Class added successfully',
                   'status'=>'success'
               ]);
           }else{
               return response()->json([
                   'message'=>'Duplicate Data',
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

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data = NewClass::where('id',$id)->get();
        return response()->json([
            'data'=>$data,
            'id'=>$id,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,$id)
    {
        NewClass::where('id',$id)->update([
            'name'=>$request->name,
            'code'=>$request->code,
            'description'=>$request->description,
            'teacher_id'=>$request->teacher
        ]);
        return redirect()->back()->with([
            'status'=>'Successfully Updated'
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        NewClass::findorfail($id)->delete();
        return redirect()->back()->with([
            'success'=>'Deleted Succssfully',
        ]);
    }
}
