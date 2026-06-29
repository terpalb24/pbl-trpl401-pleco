<?php

namespace App\Http\Controllers;

use App\Models\Robot;

class DashboardController extends Controller
{
    public function index() {
        $role = strtolower(auth()->user()->role ?? '');

        if (in_array($role, ['admin', 'operator'], true)) {
            $robot = Robot::first();
            return view(
                $role . '.dashboard',
                [
                    'api_key' => $robot['api_key'],
                    'last_loc' => $robot['location_coordinates'] ?? '1.1278 104.0532'
                ]
            );
        }

        return redirect()->route('index');
    }
}
