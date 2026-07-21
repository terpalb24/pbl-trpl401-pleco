<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Illuminate\Support\Carbon;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        $robotId = (string) Str::uuid();

        DB::table('robots')->insert([
            'robot_id' => $robotId,
            'robot_name' => 'Robot 1',
            'api_key' => Str::random(64),
            'location_coordinates' => null,
        ]);

        DB::table('collected_trash')->insert([
            'robot_id' => $robotId,
            'trash_id' => 'CAN',
            'total' => 0,
            'collected_at' => Carbon::today()->toDateString(),
        ]);
    }


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::table('robots')->where('robot_name', 'Robot 1')->delete();
    }
};
