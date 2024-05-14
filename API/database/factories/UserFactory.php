<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use App\Models\User;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\User>
 */
class UserFactory extends Factory
{
    /**
     * The current password being used by the factory.
     */
    protected static ?string $password;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'nome' => fake()->name(),
            'cpf'  => $this->gerar_cpf(),
            'email' => fake()->unique()->safeEmail(),
            'created_at' => now(),
            'updated_at' => now(),
            'remember_token' => Str::random(10),
            'password' => Hash::make('password'),

        
        ];
    }

    private function gerar_cpf()
    {
        return sprintf('%03d.%03d.%03d-%02d', mt_rand(0, 999), mt_rand(0, 999), mt_rand(0, 999), mt_rand(1, 99));
    }

    /**
     * Indicate that the model's email address should be unverified.
     */
    public function unverified(): static
    {
        return $this->state(fn (array $attributes) => [
            'email_verified_at' => null,
        ]);
    }
}
