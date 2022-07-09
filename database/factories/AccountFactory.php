<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Account>
 */
class AccountFactory extends Factory
{
    protected $model = \App\Models\Account::class;

    /**
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'uuid' => $this->faker->uuid(),
            'user_id' => User::factory()->create()->id,
            'balance' => $this->faker->randomFloat(2, 0, 10000),
            'password' => '1234',
            'number' => $this->faker->randomNumber(8),
        ];
    }
}
