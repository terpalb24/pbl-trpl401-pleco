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
            $table->uuid('owner_id');
            $table->string('api_key', 64)->unique();

            $table->foreign('owner_id')
                ->references('account_id')
                ->on('accounts')
                ->onDelete('cascade');

            $table->index(['owner_id']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('robots');
    }
};
