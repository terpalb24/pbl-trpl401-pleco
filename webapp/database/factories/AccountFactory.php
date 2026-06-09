<?php

namespace Database\Factories;

use App\Models\Account;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;
use Str;

/**
 * @extends Factory<Account>
 */
class AccountFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        // $password = '$argon2id$v=19$m=65536,t=3,p=1$6LuftmlqbGViZY+EU9lH3AJMNLnCGnURLEe2b6MdnIo$rdEjzN4sIGIf2HtdSOh8RmKcOV98VBkXknYSURo3HyY';
        $password = Hash::make('Password#123');
        $role = 'OPERATOR';

        $accounts = [
            [
                'account_id' => Str::uuid(), // Gunakan helper Str::uuid() jika di seeder
                'full_name' => 'Juan Immanuel Tinambuan',
                'email' => 'juan@gmail.com',
                'password' => $password,
                'role' => $role,
            ],
            [
                'account_id' => Str::uuid(),
                'full_name' => 'Muhammad Aidil Jupriadi Saleh',
                'email' => 'aidil@gmail.com',
                'password' => $password,
                'role' => $role,
            ]
        ];

        // return [
        //     'account_id' => $this->faker->uuid(),
        //     'full_name' => 'Juan Immanuel Tinambuan',
        //     'email' => 'juan@gmail.com',
        //     'password' => $password,
        //     'role' => $role,
        // ];

        foreach ($accounts as $account) {
            \App\Models\Account::create($account);
        }

        return [];
    }
}
