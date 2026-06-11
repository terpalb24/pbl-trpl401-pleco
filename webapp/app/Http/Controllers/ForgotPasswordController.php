<?php

namespace App\Http\Controllers;

use App\Models\Account;
use Hash;
use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Password;
use Str;

class ForgotPasswordController extends Controller
{
    public function index()
    {
        return view('forgot-password.request-email');
    }

    public function indexResetForm(string $token)
    {
        return view('forgot-password.reset-form', [
            'token' => $token,
            'email' => request()->query('email')
        ]);
    }

    public function indexSuccess()
    {
        if (!session('reset-email')) {
            $errorMessage = session()->has('errors') ?
                ['email' => session()->get('errors')->first('email')]
                : null;

            return redirect()->route('forgot-password', $errorMessage);
        }

        return view('forgot-password.success-message', [
            'email' => session('reset-email'),
        ]);
    }

    public function sendEmail(Request $request)
    {
        $errorMessage = [
            'email.required' => 'Email wajib diisi',
            'email.email' => 'Format email yang Anda masukkan tidak valid.'
        ];
        $request->validate(['email' => 'required|email'], $errorMessage);

        $status = Password::sendResetLink(
            $request->only('email')
        );

        if ($status === Password::ResetLinkSent) {
            return redirect()->route('forgot-password.success-message')->with(['reset-email' => $request->email]);
        }

        return back()->withErrors(['email' => $status]);
    }

    public function handleResetPassword(Request $request)
    {
        $errorMessage = [
            'token.required' => 'Gagal melakukan proses pengiriman.',
            'email.required' => 'Email wajib diisi.',
            'email.email' => 'Format email yang Anda masukkan tidak valid.',
            'password.required' => 'Password wajib diisi.',
            'password.min' => 'Password harus memiliki minimal 8 karakter.',
        ];

        $request->validate([
            'token' => 'required',
            'email' => 'required|email',
            'password' => 'required|min:8',
        ], $errorMessage);

        $status = Password::reset(
            $request->only('email', 'password', 'token'),
            function (Account $user, string $password) {
                $user->forceFill([
                    'password' => Hash::make($password)
                ]);

                $user->save();
                event(new PasswordReset($user));
            }
        );

        return $status === Password::PasswordReset
            ? redirect()->route('login')->with('status', 'Kata sandi berhasil diubah!')
            : back()->withErrors(['email' => $status]);
    }
}
