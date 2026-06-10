<?php

namespace Database\Seeders;

use App\Models\Account;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class AccountSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $password = Hash::make('password123');

        // Create 20 admin accounts
        for ($i = 1; $i <= 20; $i++) {
            Account::updateOrCreate(
                ['email' => "admin.test{$i}@pleco.com"],
                [
                    'account_id' => (string) Str::uuid(),
                    'full_name' => "Admin Test {$i}",
                    'password' => $password,
                    'role' => 'ADMIN',
                ]
            );
        }

        // Create 20 operator accounts
        for ($i = 1; $i <= 20; $i++) {
            Account::updateOrCreate(
                ['email' => "operator.test{$i}@pleco.com"],
                [
                    'account_id' => (string) Str::uuid(),
                    'full_name' => "Operator Test {$i}",
                    'password' => $password,
                    'role' => 'OPERATOR',
                ]
            );
        }
    }
}
