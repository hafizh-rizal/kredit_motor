<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Facades\Hash;
use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Support\Str;
use App\Http\Controllers\Controller;

class PelangganResetController extends Controller
{
    public function showResetForm(Request $request, $token = null)
    {
        return view('pelanggan.auth.reset', [
            'token' => $token,
            'email' => $request->email,
        ]);
    }

    public function reset(Request $request)
    {
        $request->validate([
            'token' => 'required',
            'email' => 'required|email',
            'password' => 'required|confirmed|min:6',
        ]);

        $status = Password::broker('pelanggan')->reset(
            $request->only('email', 'password', 'password_confirmation', 'token'),
            function ($pelanggan, $password) {
                $pelanggan->kata_kunci = Hash::make($password);
                $pelanggan->setRememberToken(Str::random(60));
                $pelanggan->save();

                event(new PasswordReset($pelanggan));
            }
        );

        return $status === Password::PASSWORD_RESET
            ? redirect()->route('pelanggan.auth.login')->with('status', __($status))
            : back()->withErrors(['email' => [__($status)]]);
    }
}
