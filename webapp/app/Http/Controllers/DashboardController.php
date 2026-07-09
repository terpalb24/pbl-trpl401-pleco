<?php

namespace App\Http\Controllers;

use App\Models\Robot;

use App\Models\Trash;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index() {
        $role = strtolower(auth()->user()->role ?? '');
        if (!in_array($role, ['admin', 'operator'], true)) {
            return redirect()->route('index');
        }

        $total = DB::table('collected_trash')
            ->select('trash_id', DB::raw('SUM(total) as total_amount'))
            ->groupBy('trash_id')
            ->get();

        $bottle_total = $total->filter(function ($item) {
            return $item->trash_id == 'BOTTLE';
        })->first()->total_amount;

        $plastic_bag_total = $total->filter(function ($item) {
            return $item->trash_id == 'PLASTIC_BAG';
        })->first()->total_amount;

        $milk_carton_total = $total->filter(function ($item) {
            return $item->trash_id == 'MILK_CARTON';
        })->first()->total_amount;

        $data = [
            'bottle' => $bottle_total,
            'plastic_bag' => $plastic_bag_total,
            'milk_carton' => $milk_carton_total,
            'all_trash' => $bottle_total + $plastic_bag_total + $milk_carton_total,
        ];

        $robot = Robot::first();
        return view(
            $role . '.dashboard',
            array_merge($data, [
                'api_key' => $robot['api_key'] ?? null,
                'last_loc' => $robot['location_coordinates'] ?? '1.1278 104.0532'
            ])
        );
    }
}
