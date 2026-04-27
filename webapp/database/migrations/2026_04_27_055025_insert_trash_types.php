<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        DB::table('trash_types')->insert([
            [
                'trash_id' => 'BOTTLE',
                'trash_name' => 'Botol',
            ],
            [
                'trash_id' => 'PLASTIC_BAG',
                'trash_name' => 'Kantong Plastik',
            ],
            [
                'trash_id' => 'PLASTIC_PACKAGING',
                'trash_name' => 'Kemasan Plastik',
            ],
            [
                'trash_id' => 'STYROFOAM',
                'trash_name' => 'Styrofoam',
            ],
            [
                'trash_id' => 'CAN',
                'trash_name' => 'Kaleng',
            ]
        ]);
    }

    public function down(): void
    {
        DB::table('trash_types')->truncate();
    }
};
