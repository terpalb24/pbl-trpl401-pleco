<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('collected_trash', function (Blueprint $table) {
            $table->uuid('robot_id');
            $table->string('trash_id', 32);
            $table->unsignedInteger('total');
            $table->date('collected_at');

            $table->foreign('trash_id')
                ->references('trash_id')
                ->on('trash_types')
                ->onDelete('cascade');

            $table->foreign('robot_id')
                ->references('robot_id')
                ->on('robots')
                ->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('collected_trash');
    }
};
