<?php

namespace Database\Factories;

use App\Models\User;
use App\Support\Enums\UserRoleEnum;
use Faker\Generator;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

/**
 * @extends Factory
 */
class UserFactory extends Factory
{
    protected $model = User::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $faker = $this->withFaker();
        return [
            'name' => $faker->name(),
            'email' => $faker->safeEmail(),
            'email_verified_at' => now(),
            'password' => Hash::make('123456'),
            'remember_token' => Str::random(10),
            'cpf' => $faker->cpf(),
            'rg' => $faker->rg(),
            'phone' => $faker->phoneNumber(),
            'role' => UserRoleEnum::COMMON,
        ];
    }

    /**
     * Get a new Faker instance.
     *
     * @return Generator
     */
    public function withFaker(): Generator
    {
        return \Faker\Factory::create('pt_BR');
    }

    /**
     * Indicate that the model's email address should be unverified.
     *
     * @return static
     */
    public function unverified(): static
    {
        return $this->state(function (array $attributes) {
            return [
                'email_verified_at' => null,
            ];
        });
    }
}
