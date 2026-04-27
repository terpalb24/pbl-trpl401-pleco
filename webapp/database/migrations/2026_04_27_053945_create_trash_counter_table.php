<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('trash_counter', function (Blueprint $table) {
            $table->uuid('robot_id');
            $table->string('trash_id', 32);
            $table->unsignedInteger('amount')->default(0);

            $table->foreign('trash_id')
                ->references('trash_id')
                ->on('trash_types')
                ->onDelete('cascade');

            $table->index(['robot_id']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('trash_counter');
    }
};
