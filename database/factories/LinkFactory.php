<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Link>
 */
class LinkFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $duration = fake()->numberBetween(1, 31);

        return [
            'url' => fake()->url(),
            'identifier' => fake()->unique()->regexify('[A-Za-z0-9]{5}'),
            'clicks' => fake()->numberBetween(0, 100),
            'duration' => $duration,
            'expires_at' => now()->addDays($duration),
        ];
    }
}
