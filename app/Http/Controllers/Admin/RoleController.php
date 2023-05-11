<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RoleController extends Controller
{
    public function index(){
        $user=Auth::user();
        if($user->hasAnyRole([ 'super_admin'])){
            $roles =  Role::orderBy('id','DESC')->get();
        }else{
            $roles = Role::where('name','!=','super_admin')->get();
        }
        return view('admin.roles.index',compact('roles'));
    }
    public function show($id){
        $role =  Role::where('id',$id)->first();
        $permissions = Permission::orderBy('id','DESC')->get();
        $all_permissions = Permission::orderBy('id','DESC')->get();
        $permissions_groups = Permission::select('group_name')->groupBy('group_name')->get();
        return view('admin.roles.show',compact(['role','permissions','permissions_groups','all_permissions']));
    }
    public function create(){
        $permissions = Permission::orderBy('id','DESC')->get();
        $permissions_groups = Permission::select('group_name')->groupBy('group_name')->get();
        return view('admin.roles.create',compact(['permissions','permissions_groups']));
    }
    public function store(Request $request){
        $request->validate([
            'name'=>'required|unique:roles|min:3',
            'guard_name'=>'required|min:3',
        ]);
        $role =  Role::create([
            'name' => $request->name,
            'guard_name' => $request->guard_name
        ]);

        $role->syncPermissions($request->permissions);
        return redirect()->route('admin.roles.index')->withSuccess('Role Created', $request->name. 'has been created!');;
    }
    public function edit($id){

        $role =  Role::where('id',$id)->first();
        $permissions = Permission::where('guard_name',$role->guard_name)->get();
        $all_permissions = Permission::where('guard_name',$role->guard_name)->get();
        $permissions_groups = Permission::select('group_name')->groupBy('group_name')->where('guard_name',$role->guard_name)->get();
        return view('admin.roles.edit',compact(['role','permissions','permissions_groups','all_permissions']));
    }
    public function update(Request $request,$id){
        $request->validate([
            'name'=>'required|min:3',

        ]);
        $role = Role::where('id',$id)->first();
        $role->update([
            'name' => $request->name,

        ]);

        $role->syncPermissions($request->permissions);
        return redirect()->back()->withSuccess('Role Update', 'Role has been updated!');;
    }
    public function destroy($id){
        Role::find($id)->delete();

        return redirect()->back()->withSuccess('Role Deleted', 'Role has been deleted!');;
    }

}
