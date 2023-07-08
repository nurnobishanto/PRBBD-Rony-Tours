<?php

namespace App\Http\Controllers\FrontEnd;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserProfileController extends Controller
{
    public function edit()
    {
        $user = auth('web')->user();
        $json_data = file_get_contents('json/country.json');
        $countries = json_decode($json_data);
        return view('frontend.user.profile', compact( 'user','countries'));
    }

    public function update(Request $request)
    {
        $user = auth('web')->user();

        $input = $request->validate([
            'email' => 'required|string|max:255|unique:users,email,'.$user->id,
            'country' => 'nullable|string|max:255',
            'first_name' => 'nullable|string|max:255',
            'last_name' => 'nullable|string|max:255',
            'phone' => 'nullable|numeric|min:11',
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

        ]);
        $user->update($input);
        $user->name = $request->first_name.' '.$request->last_name;
        $user->update();
        if ($request->file('image')) {
            $request->validate([
                'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            ]);
            $imageName = time().'.'.$request->file('image')->extension();
            $request->file('image')->move(public_path('uploads'), $imageName);
            $user->image = $imageName;
            $user->update();
        }
        return redirect()->back()->with('success', 'User Update Successfully');
    }

    public function password_update(Request $request)
    {
        $user = auth('web')->user();
        $request->validate([
            'current_password' => 'required|string|min:6',
            'password' => 'required|string|min:6',
            'confirm_password' => 'required|same:password|string|min:6',
            // 'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            // 'company_logo' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            // 'trade_licence' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            // 'passport' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);


        #Match The Old Password
        if(!Hash::check($request->current_password, auth()->user()->password)){
            return back()->with("error", "Old Password Doesn't match!");
        }

        #Update the new Password
        User::whereId(auth()->user()->id)->update([
            'password' => Hash::make($request->password)
        ]);

        return redirect()->back()->with('success', 'User Password Update Successfully');
    }
}
