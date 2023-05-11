<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Spatie\Permission\Models\Role;

class UserController extends Controller
{

    public function index()
    {
        $users = User::orderBy('id','DESC')->get();
        return view('admin.users.index',compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.users.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'username' => [ 'string','max:255', 'unique:users'],
            'mobile' => [ 'string',  'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:6'],
            'confirm_password' => 'required_with:password|same:password|min:6'
        ]);
        $imageUrl = "";
        if($request->file('photo')){
            $request->validate([
                'photo' => 'required|image|max:2048',
            ]);
            $file = $request->file('photo');
            $fileName = "user".time().$file->getClientOriginalName();
            $destinationPath = 'uploads';
            $file->move($destinationPath,$fileName);
            $imageUrl = $destinationPath."/".$fileName;
        }
        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'username' => $request->username,
            'mobile' => $request->mobile,
            'is_active' => $request->is_active,
            'photo' => $imageUrl,
        ]);
        toastr()->success('User has been created successfully','User Created');
        return redirect()->route('admin.users.index');

    }

    public function show(string $id)
    {
        $user = User::find($id);
        return view('admin.users.show',compact('user'));
    }


    public function edit(string $id)
    {
        $user = User::find($id);
        return view('admin.users.edit',compact('user'));
    }


    public function update(Request $request, string $id)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users,email,'.$id],
            'username' => [ 'max:255', 'unique:users,username,'.$id],
            'mobile' => [ 'max:255', 'unique:users,mobile,'.$id],
        ]);
        if(strlen($request->password)>0){
            $request->validate([
                'password' => ['required', 'string', 'min:6'],
                'confirm_password' => 'required_with:password|same:password|min:6'
            ]);
        }

        $imageUrl = "";
        if($request->file('photo')){
            $request->validate([
                'photo' => 'required|image|max:2048',
            ]);
            $file = $request->file('photo');
            $fileName = "user".time().$file->getClientOriginalName();
            $destinationPath = 'uploads';
            $file->move($destinationPath,$fileName);
            $imageUrl = $destinationPath."/".$fileName;
        }

        $user = User::find($id);
        $user->username = $request->username;
        $user->name = $request->name;
        $user->email = $request->email;
        $user->mobile = $request->mobile;
        $user->is_active = $request->is_active;
        $user->photo = $imageUrl;
        if(strlen($request->password)>5){
            $user->password = Hash::make($request->password);
        }
        $user->update();
        toastr()->success('User has been updated successfully!','User updated');
        return redirect()->route('admin.users.index');
    }


    public function destroy(string $id)
    {
        User::find($id)->delete();
        return redirect()->back()->withSuccess('User Deleted', 'User has been deleted!');;
    }
}
