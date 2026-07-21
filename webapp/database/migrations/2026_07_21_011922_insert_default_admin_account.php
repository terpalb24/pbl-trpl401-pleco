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
        DB::table('accounts')->insert([
            'account_id' => (string) Str::uuid(),
            'full_name' => 'Admin',
            'email' => 'admin@ple.co',
            'password' => Hash::make('1001_DoaIbu:)'),
            'role' => 'ADMIN',
        ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::table('accounts')->where('email', 'admin@ple.co')->delete();
    }
};
