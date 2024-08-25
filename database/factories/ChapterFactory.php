<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Chapter>
 */
class ChapterFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
          'chapter_title' => $this->faker->words(3, true),
          'content' => $this->faker->paragraphs(5, true),
          'summary' => $this->faker->paragraph(3),
          'beginning_notes' => $this->faker->paragraph(2),
          'end_notes' => $this->faker->paragraph(2),
          'word_count' => $this->faker->numberBetween(1200, 7650),
          // 'is_published' => true,
          // 'published_at' => $this->faker->dateTime('now'),
          // 'is_complete' => true,
          // 'completed_at' => $this->faker->dateTime('now'),
          // 'revised_at' => $this->faker->dateTime('now'),
          'created_at' => $this->faker->dateTime('now'),
          'updated_at' => $this->faker->dateTime('now'),
        ];
    }
}
