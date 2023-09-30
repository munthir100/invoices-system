<?php

namespace Database\Factories;

use App\Models\Status;
use App\Models\UserType;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Config;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\User>
 */
class UserFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $permissions = array_merge(
            Config::get('permissions.administrator-permissions', []),
            Config::get('permissions.saleperson-permissions', [])
        );

            return [
                'name' => 'administrator',
                'email' => 'admin@admin.com',
                'email_verified_at' => now(),
                'password' => 'password', // password
                'status_id' => 1, // Set an appropriate status_id.
                'user_type_id' => UserType::SALESPERSON, // Use the constant.
                'remember_token' => Str::random(10),
                'status_id' => Status::ACTIVE,
            ];
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
