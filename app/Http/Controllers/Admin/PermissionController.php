<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;



class PermissionController extends Controller
{
    public function index(){
        $permissions =  Permission::orderBy('id','DESC')->get();
        return view('admin.permissions.index',compact('permissions'));
    }
    public function create(){
        return view('admin.permissions.create');
    }
    public function store(Request $request){

        $request->validate([
            'name'=>'required|unique:permissions|min:3',
            'guard_name'=>'required|min:3',
            'group_name'=>'required|min:3',
        ]);
        Permission::create([
            'name' => $request->name,
            'guard_name' => $request->guard_name,
            'group_name' => $request->group_name,
        ]);
        return redirect()->route('admin.permissions.index')->withSuccess('Permission Created', $request->name. 'has been created!');
    }
    public function destroy($id){
        Permission::find($id)->delete();
        toastr('Data has been deleted!','error','Deleted');
        return redirect()->back();
    }
    public function edit($id){
        $permission = Permission::find($id);
        return view('admin.permissions.edit',compact('permission'));
    }
    public function update(Request $request,$id){
        $request->validate([
            'name'=>'required|unique:permissions,name,'.$id.'|min:3',
            'guard_name'=>'required|min:3',
            'group_name'=>'required|min:3',
        ]);
        $permission = Permission::where('id',$id)->first();
        $permission->update([
            'name' => $request->name,
            'guard_name' => $request->guard_name,
            'group_name' => $request->group_name,
        ]);
        toastr('Data has been updated!','success','Updated');
        return redirect()->back();
    }
    public function show($id){
        $permission = Permission::find($id);
        return view('admin.permissions.show',compact('permission'));
    }
}
