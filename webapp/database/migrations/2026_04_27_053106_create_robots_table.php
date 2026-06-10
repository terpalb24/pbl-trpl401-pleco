<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('robots', function (Blueprint $table) {
            $table->uuid('robot_id')->primary();
            $table->string('robot_name', 32);
            $table->string('api_key', 64)->unique();
            $table->string('location_coordinates', 64)->unique()->nullable();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('robots');
    }
};
