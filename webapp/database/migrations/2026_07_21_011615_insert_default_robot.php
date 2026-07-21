<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        DB::table('robots')->insert([
            'robot_id' => (string) Str::uuid(),
            'robot_name' => 'Robot 1',
            'api_key' => Str::random(64),
            'location_coordinates' => null,
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
