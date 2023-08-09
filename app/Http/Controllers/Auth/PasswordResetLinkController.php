<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Mail\SendEmail;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Password;
use Illuminate\View\View;
use Psy\Util\Str;

class PasswordResetLinkController extends Controller
{
    /**
     * Display the password reset link request view.
     */
    public function create(): View
    {
        return view('auth.forgot-password');
    }

    /**
     * Handle an incoming password reset link request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'email' => ['required', 'email'],
        ]);

        $user = User::where('email', $request->input('email'))->first();

        if (!$user) {
            return back()->withErrors(['email' => 'User not found']);
        }

        $token = uniqid();
        $user->remember_token = $token;
        $user->update();

        $subject = 'Password Reset '.getSetting('site_title');
        $name = $user->name;
        $email = $user->email;
        $url = route('password.reset', ['token' => $user->remember_token, 'email' => $user->email]);
        $body  = '<p>Hello, '.$name.' </p><p>Click the following link to reset your password:</p><a href="'.$url.'">Reset Password</a>';
        email_send($email,$subject,$body);
        return back()->with('status', 'Password reset link sent.');
    }
}
