<?php

namespace Database\Factories;

use App\Models\Account;
use Illuminate\Database\Eloquent\Factories\Factory;

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
        $password = '$argon2id$v=19$m=65536,t=3,p=1$6LuftmlqbGViZY+EU9lH3AJMNLnCGnURLEe2b6MdnIo$rdEjzN4sIGIf2HtdSOh8RmKcOV98VBkXknYSURo3HyY';
        $role = 'OPERATOR';

        return [
            'account_id' => $this->faker->uuid(),
            'full_name' => $this->faker->name(),
            'email' => $this->faker->unique()->safeEmail(),
            'password' => $password,
            'role' => $role,
        ];
    }
}
