<?php

namespace App\Http\Controllers\Admin;

use App\Permission;
use App\Role;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $roles = DB::table('roles')
            ->where('school_id',auth()->user()->school_id)
            ->select('name','id','display_name')
            ->get();
        return view('admin.roles.index',[
            'roles'=>$roles
        ]);
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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $data = Permission::all()->groupBy('table_name');
        $role_perm = DB::table('permission_role')
            ->where('permission_role.role_id',$id)
            ->leftJoin('permissions','permission_role.permission_id','permissions.id')
            ->select('permissions.name')
            ->get()->toArray();
        $role = Role::where('school_id',auth()->user()->school_id)
            ->where('id',$id)
            ->pluck('display_name')
            ->first();
        $collectTemp = [];
        foreach($role_perm as $key=>$value){
            array_push($collectTemp,$value->name);
        }

        return view('admin.roles.edit',[
            'tables'=>$data,
            'role_permissions'=>$collectTemp,
            'role_id'=>$id,
            'display_name'=>$role
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {

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
       DB::table('permission_role')->where('role_id',$id)->delete();
        foreach($request->permissions as $permission){
            DB::table('permission_role')->insert([
                'permission_id'=>$permission,
                'role_id'=>$id,

            ]);
        }
        return redirect()->back()->with([
            'success'=>'Editted Roles Successfully'
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
        //
    }
}
