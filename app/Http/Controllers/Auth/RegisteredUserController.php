<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\View\View;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): View
    {
        $json_data = file_get_contents('json/country.json');
        $countries = json_decode($json_data);
        return view('auth.register',compact('countries'));
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'email' => ['required', 'string', 'email', 'max:255', 'unique:'.User::class],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'gender' => 'required',
            'dob' => 'required|date',
            'phone' => 'required|numeric|digits:10',
            'country' => 'required|string|max:255',
            'city' => 'required|string|max:255',
            'post_code' => 'required|string|max:255',
            'address' => 'required|string|max:255',
        ]);


        $user = User::create([
            'name' => $request->first_name.' '.$request->last_name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'pass_text' => $request->password,
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'dob' => $request->dob,
            'country' => $request->country,
            'country_code' => $request->country_code,
            'time_zone' => $request->time_zone,
            'phone' => $request->phone_code.$request->phone,
            'contact_number' => $request->phone_code.$request->phone,
            'city' => $request->city,
            'post_code' => $request->post_code,
            'address' => $request->address,
            'gender' => $request->gender,
            'user_type' => 0,
            'is_active' => 1,
        ]);
        $msg = 'পিআরবি বিডি তে ,আপনার রেজিস্ট্রেশন  সফল হয়েছে। আপনার পাসওয়ার্ড : '.$request->password.' ইমেইল: '.$request->email.',লগইন করতে ভিসিট করুন : prbbd.com/login';
        send_sms($request->phone_code.$request->phone,$msg,'Account Registration');
        email_send($request->email,'Account Registration',$msg);

        event(new Registered($user));

        Auth::guard('web')->login($user);

        return redirect(RouteServiceProvider::HOME);
    }
}
