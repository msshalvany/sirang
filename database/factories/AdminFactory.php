<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Admin>
 */
class AdminFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'username' => fake()->name(),
            'password' => '$2y$10$3QSrRj9UUKT8qDt29YAHJunj15M4upb.5WSPQXIQ13aPrmImUpwzG', // password
        ];
    }
}
