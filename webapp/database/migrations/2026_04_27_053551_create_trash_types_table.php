<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('trash_types', function (Blueprint $table) {
            $table->string('trash_id', 32)->primary();
            $table->string('trash_name', 32);

            $table->index(['trash_id']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('trash_types');
    }
};
