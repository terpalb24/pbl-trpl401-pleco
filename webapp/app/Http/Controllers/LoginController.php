<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;

class LoginController extends Controller
{
    public function index() {
        return view('login');
    }

    public function store(LoginRequest $request) {
        if (!Auth::attempt($request->only('email', 'password'))) {
            throw ValidationException::withMessages([
                'email' => 'Maaf, email atau kata sandi Anda salah.',
            ]);
        }

        return redirect()->route('dashboard');
    }
}
