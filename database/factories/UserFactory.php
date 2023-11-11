<?php

namespace Database\Factories;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

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
    public function definition()
    {
        // return [
        //     'fname' => fake()->firstName(),
        //     'lname' => fake()->lastName(),
        //     'email' => fake()->unique()->safeEmail(),
        //     'email_verified_at' => now(),
        //     'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
        //     'remember_token' => Str::random(20),
        //     'gender' =>fake()->randomElement(['Male', 'Female', 'Prefer not to say', 'Prefer to self-describe']),
        //     'contact'=> fake()->phoneNumber(),
        //     'occupation' => fake()->randomElement(['Student', 'Employed (Full-time)', 'Employed (Part-time)', 'Self-employed', 'Homemake', 'Retired', 'Others']),
        //     'age' => fake()->numberBetween(18,55),
        //     'educational_level' => fake()->randomElement(['No schooling', 'Elementary', 'High School', 'Vocational', 'College', 'Postgraduate']),
        //     'address' => fake()->address(),
        //     'created_at' => fake()->date(),
        //     'updated_at' => fake()->date(),
        // ];
        $startDate = Carbon::create(2023, 1, 1, 0, 0, 0);
        $endDate = Carbon::now();

        // Generate a random date within the specified range
        $randomDate = fake()->dateTimeBetween($startDate, $endDate);
        return [
            'fname' => fake()->firstName(),
            'lname' => fake()->lastName(),
            'email' => fake()->unique()->safeEmail(),
            'email_verified_at' => now(),
            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
            'remember_token' => Str::random(20),
            'gender' =>fake()->randomElement(['Male', 'Female', 'Prefer not to say', 'Prefer to self-describe']),
            'contact'=> fake()->phoneNumber(),
            'occupation' => fake()->randomElement(['Student', 'Employed (Full-time)', 'Employed (Part-time)', 'Self-employed', 'Homemake', 'Retired', 'Others']),
            'age' => fake()->numberBetween(18,55),
            'educational_level' => fake()->randomElement(['No schooling', 'Elementary', 'High School', 'Vocational', 'College', 'Postgraduate']),
            'address' => fake()->address(),
            'created_at' => $randomDate,
            'updated_at' => fake()->date(),
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
