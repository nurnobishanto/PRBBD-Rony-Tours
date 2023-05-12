<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;

class AdminController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $admins  = Admin::all();
        return view('admin.admins.index',compact('admins'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $roles = Role::all();
        return view('admin.admins.create',compact('roles'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:admins'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);
        Admin::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ])->assignRole($request->role);
        toastr()->success('Admin created successful!');
        return redirect()->route('admin.admins.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $admin = Admin::find($id);
        return view('admin.admins.create',compact(['admin']));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $roles = Role::all();
        $admin = Admin::find($id);
        return view('admin.admins.edit',compact(['roles','admin']));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $admin = Admin::find($id);
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:admins,id,'.$id],
        ]);
        $admin->name = $request->name;
        $admin->email = $request->email;

        if(strlen($request->password)>5){
            $request->validate([
                'password' => ['required', 'string', 'min:8', 'confirmed'],
            ]);
            $admin->password = Hash::make($request->password);
        }

        $admin->update();
        $admin->syncRoles($request->role);
        toastr()->success('Admin updated successful!');
        return redirect()->back();

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        Admin::find($id)->delete();
        toastr()->success('Admin deleted successful!');
        return redirect()->back();
    }
    public function trashed()
    {
        $admins = Admin::onlyTrashed()->get();

        return view('admin.admins.index',compact('admins'));
    }
}
