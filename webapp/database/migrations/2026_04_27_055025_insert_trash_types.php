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
                'trash_id' => 'MILK_CARTON',
                'trash_name' => 'Karton Susu',
            ]
        ]);
    }

    public function down(): void
    {
        DB::table('trash_types')->truncate();
    }
};
