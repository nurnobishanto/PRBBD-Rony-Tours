<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Str;
use Illuminate\Validation\Rules;
use Illuminate\View\View;

class NewPasswordController extends Controller
{
    /**
     * Display the password reset view.
     */
    public function create(Request $request): View
    {
        return view('auth.reset-password', ['request' => $request]);
    }

    /**
     * Handle an incoming new password request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'token' => ['required'],
            'email' => ['required', 'email'],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);

        $user = User::where('email', $request->email)->first();

        if (!$user) {
            toastr()->error( 'User not found');
            return redirect()->back();
        }

        if ($request->token != $user->remember_token) {
            toastr()->error( $request->token.'?'.$user->remember_token,'Invalid token');
            return redirect()->back();
        }

        $user->password = Hash::make($request->password);
        $user->remember_token = Str::random(60);
        $user->save();


        $subject = 'Password reset successfully '.getSetting('site_title');
        $name = $user->name;
        $email = $user->email;
        $body  = '<p>Hello, '.$name.' </p>
                    <h2>Password Reset Successful</h2>
                    <p>Your password has been successfully reset.</p>
                    <p>If you did not request this password reset, please contact our support team.</p>';
        email_send($email,$subject,$body);

        return redirect()->route('login')->with('status', 'Password reset successfully');
    }
}
