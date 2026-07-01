<?php

namespace App\Http\Controllers;

use App\Models\Robot;

use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index() {
        $role = strtolower(auth()->user()->role ?? '');

        // Fetch trash counts from database
        $trashCounts = DB::table('trash_counter')
            ->select('trash_id', DB::raw('SUM(amount) as total'))
            ->groupBy('trash_id')
            ->pluck('total', 'trash_id')
            ->toArray();

        $botol_mineral = $trashCounts['BOTTLE'] ?? 0;
        $plastik = ($trashCounts['PLASTIC_BAG'] ?? 0) + ($trashCounts['PLASTIC_PACKAGING'] ?? 0);
        $karton_susu = $trashCounts['MILK_CARTON'] ?? 0;
        $lainnya = ($trashCounts['CAN'] ?? 0) + ($trashCounts['STYROFOAM'] ?? 0);

        $totalTrash = array_sum($trashCounts);

        $data = [
            'botol_mineral' => $botol_mineral,
            'plastik' => $plastik,
            'karton_susu' => $karton_susu,
            'lainnya' => $lainnya,
            'totalTrash' => $totalTrash,
        ];

        if (in_array($role, ['admin', 'operator'], true)) {
            $robot = Robot::first();
            return view(
                $role . '.dashboard',
                array_merge($data, [
                    'api_key' => $robot['api_key'] ?? null,
                    'last_loc' => $robot['location_coordinates'] ?? '1.1278 104.0532'
                ])
            );
        }

        return redirect()->route('index');
    }
}
