<?php

namespace App\Http\Controllers;

class DashboardController extends Controller
{
    public function index() {
        $role = strtolower(auth()->user()->role ?? '');

        if ($role === 'admin') {
            return view('admin.dashboard');
        }

        return view('operator.dashboard');
    }
}
