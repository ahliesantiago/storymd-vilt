<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Work>
 */
class WorkFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
          'title' => $this->faker->words(3, true),
          'creator_id' => $this->faker->numberBetween(1, 10),
          'expected_chapter_count' => $this->faker->numberBetween(1, 10),
          'word_count' => $this->faker->numberBetween(1200, 17650),
          'language_code' => 'la',
          'rating_id' => $this->faker->numberBetween(1, 5),
          'created_at' => now(),
          'updated_at' => now(),
          'is_complete' => false,
          'completed_at' => now(),
        ];
    }
}
