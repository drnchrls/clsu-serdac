<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\PrivUser>
 */
class StaffFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'staff_fname' => fake()->firstName(),
            'staff_lname' => fake()->lastName(),
            'staff_email' => fake()->unique()->safeEmail(),
            'email_verified_at' => now(),
            'staff_password' => bcrypt('12345678'), // password
            'remember_token' => Str::random(20),
            'staff_role' => fake()->randomElement(['Library Staff', 'Service Staff']),
            'staff_contact'=> fake()->phoneNumber(),

        ];
    }

    /**
     * Indicate that the model's email address should be unverified.
     *
     * @return static
     */
    public function unverified()
    {
        return $this->state(fn (array $attributes) => [
            'email_verified_at' => null,
        ]);
    }
}
