<?php

namespace App\Http\Controllers;

use App\Models\Trash;
use Carbon\Carbon;
use Carbon\CarbonPeriod;
use Carbon\Exceptions\InvalidFormatException;
use Illuminate\Http\Request;
use function PHPUnit\Framework\isEmpty;

class StatsController extends Controller
{
    public function index(Request $request) {
        $data = $request->validate([
            'period' => ['required', 'string', 'in:one_day,daily,monthly,yearly'],
            'start'  => ['required', 'string'],
        ]);

        $period = $data['period'];
        $start = $data['start'];

        if ($period == 'one_day') {
            try {
                Carbon::parse($start); // Check if the date is valid

                $data = Trash::whereDate('collected_at', $start)
                    ->select(['trash_id', 'total'])
                    ->get();

                return $data;
            } catch (InvalidFormatException) {
                return response()->json('Bad Request', 400);
            }
        }

        $int_start = intval($start);
        if (is_nan($int_start)) return response()->json('Bad Request', 400);

        if ($period == 'daily') {
            return getDailyStats($int_start);
        } else if ($period == 'monthly') {
            return getMonthlyStats($int_start);
        } else if ($period == 'yearly') {
            return getYearlyStats($int_start);
        }

        return [];
    }
}

function getDailyStats(string $start_date) {
    $start = Carbon::parse('2026-07-' . $start_date);
    $end   = $start->copy()->subDays(6);

    $date_for_prev = $end->copy()->subDays()->format('j');
    $date_for_next = $start->copy()->addDays(7)->format('j');

    $dates = CarbonPeriod::create($end, $start)->toArray();
    $dates = array_map(function ($date) {
        return $date->format('j F');
    }, $dates);

    $data = Trash::whereBetween('collected_at', [$end, $start])
        ->select(['total', 'collected_at'])
        ->get();

    if ($data->isEmpty()) return response()->json(
        (object) [
            'labels' => $dates,
            'data' => [],
            'info' => [
                'date_for_prev' => $date_for_prev,
                'date_for_next' => $date_for_next,
            ]
        ]
    );

    $trashes = [];
    foreach ($data as $trash) {
        $trashDate = Carbon::parse($trash->collected_at)->format('j F');

        if (empty($trashes)) {
            $trashes[] = (object) [
                'total' => $trash->total,
                'collected_at' => $trashDate,
            ];
            continue;
        }

        $matchIndex = null;
        foreach ($trashes as $index => $item) {
            if (Carbon::parse($item->collected_at)->format('j F') === $trashDate) {
                $matchIndex = $index;
                break;
            }
        }

        if ($matchIndex === null) {
            $trashes[] = (object) [
                'total' => $trash->total,
                'collected_at' => $trashDate,
            ];
            continue;
        }

        $trashes[$matchIndex]->total += $trash->total;
    }

    return (object) [
        'labels' => $dates,
        'data' => $trashes,
        'info' => [
            'date_for_prev' => $date_for_prev,
            'date_for_next' => $date_for_next,
        ]
    ];
}

function getMonthlyStats(string $year) {
    $labels = ['Jan', 'Feb', 'Mar' ,'Apr', 'Mei', 'Jun', 'Jul', 'Agu', 'Sep', 'Okt', 'Nov', 'Des'];
    $data = Trash::select(['total', 'collected_at'])
        ->whereYear('collected_at', $year)
        ->get();

    $byMonth = $data
        ->groupBy(fn ($r) => Carbon::parse($r->collected_at)->format('m'))
        ->map(fn ($items, $month) => [
            'month' => $labels[intval($month) - 1],
            'total' => $items->sum('total'),
        ])
        ->values();

    return (object) [
        'labels' => $labels,
        'data' => $byMonth->toArray(),
        'info' => [
            'year_for_prev' => intval($year) - 1,
            'year_for_next' => intval($year) + 1,
        ]
    ];
}

function getYearlyStats(string $start_year) {
    $prev_4_years = intval($start_year) - 4;
    $labels = range($prev_4_years, $start_year);

    $data = Trash::select(['total', 'collected_at'])->get();
    $byYear = $data
        ->groupBy(fn ($r) => Carbon::parse($r->collected_at)->format('Y'))
        ->map(fn ($items, $year) => [
            'year'  => (int) $year,
            'total' => $items->sum('total'),
        ])
        ->values();

    return (object) [
        'labels' => $labels,
        'data' => $byYear->toArray(),
        'info' => [
            'year_for_prev' => $prev_4_years - 1,
            'year_for_next' => intval($start_year) + 5,
        ]
    ];
}

