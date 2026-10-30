<?php

namespace App\Http\Controllers;

use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Str;
use Illuminate\Validation\Rules\Password as PasswordRule;

class PasswordResetController extends Controller
{
    // GET /forgot-password
    public function request()
    {
        return view('forgot-password');
    }

    // POST /forgot-password
    public function email(Request $request)
    {
        $request->validate(['email' => ['required', 'email']]);

        // Always show the same message, so nobody can use this form
        // to find out which emails have an account.
        Password::sendResetLink($request->only('email'));

        return back()->with('status', 'If that email has an account, we have sent a password reset link to it.');
    }

    // GET /reset-password/{token}
    public function reset(Request $request, string $token)
    {
        return view('reset-password', [
            'token' => $token,
            'email' => $request->query('email'),
        ]);
    }

    // POST /reset-password
    public function update(Request $request)
    {
        $request->validate([
            'token'    => ['required'],
            'email'    => ['required', 'email'],
            'password' => ['required', 'confirmed', PasswordRule::min(8)],
        ]);

        $status = Password::reset(
            $request->only('email', 'password', 'password_confirmation', 'token'),
            function ($user, $password) {
                $user->forceFill([
                    'password'       => Hash::make($password),
                    'remember_token' => Str::random(60),
                ])->save();

                event(new PasswordReset($user));
            }
        );

        if ($status === Password::PASSWORD_RESET) {
            return redirect('/login')->with('status', 'Your password has been reset. Please log in.');
        }

        return back()
            ->withInput($request->only('email'))
            ->withErrors(['email' => 'This reset link is invalid or has expired. Please request a new one.']);
    }
}