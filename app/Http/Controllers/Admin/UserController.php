<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Traits\FileUpload;

class UserController extends Controller
{
    use FileUpload;

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
        $json_data = file_get_contents('json/country.json');
        $countries = json_decode($json_data);

        return view('admin.users.create', compact('countries'));
    }

    public function store(Request $request)
    {
        $input = $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => 'required|string|unique:users|max:255',
            'country' => 'nullable|string|max:255',
            'phoneCode' => 'nullable|string|max:255',
            'phone' => 'nullable|numeric',
            'company_name' => 'nullable|string|max:555',
            'passport_no' => 'nullable|string|max:555',
            'passport_exp' => 'nullable|string',
            'address' => 'nullable|string|max:5555',
            'post_code' => 'nullable|numeric',
            'city' => 'nullable|string|max:255',
            'time_zone' => 'nullable|string|max:255',
            'balance' => 'nullable|numeric',
            'dob' => 'nullable|date|max:255',
            'is_active' => 'nullable|numeric',
            'gender' => 'nullable|numeric',
            'user_type' => 'nullable|numeric',
            'password' => 'required', 'string', 'min:6',
            'confirm_password' => 'required_with:password|same:password|min:6',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'company_logo' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'trade_licence' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'passport' => 'mimes:jpeg,png,jpg,gif',
        ]);

        if($request->has('image'))
        {
            $input['image'] = $this->uploadFile($request->file('image'), 'users');
        }

        if($request->has('company_logo'))
        {
            $input['company_logo'] = $this->uploadFile($request->file('company_logo'), 'users');
        }

        if($request->has('trade_licence'))
        {
            $input['trade_licence'] = $this->uploadFile($request->file('trade_licence'), 'users');
        }

        if($request->has('passport'))
        {
            $input['passport'] = $this->uploadFile($request->file('passport'), 'users');
        }

        $input['password'] = Hash::make($request->password);
        $input['name'] = $request->first_name.' '.$request->last_name;
        $input['phone'] = $request->phoneCode.$request->phone;

        try{
            User::create($input);
            return redirect()->back()->with('success', 'User Create Successfully');
        }
        catch(\Exception $e){
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    public function show(User $user)
    {
        $json_data = file_get_contents('json/country.json');
        $countries = json_decode($json_data);

        return view('admin.users.show',compact('user', 'countries'));
    }


    public function edit(User $user)
    {
        $json_data = file_get_contents('json/country.json');
        $countries = json_decode($json_data);

        return view('admin.users.edit',compact('user', 'countries'));
    }


    public function update(Request $request, User $user)
    {

        $input = $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => 'required|string|max:255|unique:users,email,'.$user->id,
            'country' => 'nullable|string|max:255',
            'phoneCode' => 'nullable|string|max:255',
            'phone' => 'nullable|numeric',
            'company_name' => 'nullable|string|max:555',
            'passport_no' => 'nullable|string|max:555',
            'passport_exp' => 'nullable|string',
            'address' => 'nullable|string|max:5555',
            'post_code' => 'nullable|numeric',
            'city' => 'nullable|string|max:255',
            'time_zone' => 'nullable|string|max:255',
            'balance' => 'nullable|numeric',
            'dob' => 'nullable|date|max:255',
            'is_active' => 'nullable|numeric',
            'gender' => 'nullable|numeric',
            'user_type' => 'nullable|numeric',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'company_logo' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'trade_licence' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'passport' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        if($request->has('image'))
        {
            if($user->image != null) $this->deleteFile($user->image);
            $input['image'] = $this->uploadFile($request->file('image'), 'users');
        }

        if($request->has('company_logo'))
        {
            if($user->company_logo != null) $this->deleteFile($user->company_logo);
            $input['company_logo'] = $this->uploadFile($request->file('company_logo'), 'users');
        }

        if($request->has('trade_licence'))
        {
            if($user->trade_licence != null) $this->deleteFile($user->trade_licence);
            $input['trade_licence'] = $this->uploadFile($request->file('trade_licence'), 'users');
        }

        if($request->has('passport'))
        {
            if($user->passport != null) $this->deleteFile($user->passport);
            $input['passport'] = $this->uploadFile($request->file('passport'), 'users');
        }
        if($request->has('password'))
        {
            $request->validate([
                'password' => 'required', 'string', 'min:6',
                'confirm_password' => 'required|same:password|min:6',
            ]);
            if ($request->password === $request->confirm_password){
                $input['password'] = Hash::make($request->password);
            }else{
                toastr()->warning('Confirm Password not matched!');
            }

        }
        $input['name'] = $request->first_name.' '.$request->last_name;
        $input['phone'] = $request->phoneCode.$request->phone;
        $user->update($input);
        return redirect()->back()->with('success', 'User Update Successfully');

    }

    public function destroy(User $user)
    {
        $user->delete();
        return redirect()->back()->with('success', 'User Delete Successfully');
    }

    public function trashed()
    {
        $users = User::onlyTrashed()->get();
        return view('admin.users.index', compact('users'));
    }

    public function restore($id)
    {
        User::withTrashed()->where('id', $id)->restore();
        return redirect()->back()->with('success', 'User Restore Successfully');
    }
}
