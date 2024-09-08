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
        $paragraphs = [];

        for ($i = 0; $i < 5; $i++) {
          $paragraphs[] = $this->faker->paragraph(15);
        }

        return [
          'chapter_title' => $this->faker->words(3, true),
          // 'content' => $this->faker->paragraphs(5, true),
          'content' => implode("\n\n", $paragraphs),
          'summary' => $this->faker->paragraph(3),
          'beginning_notes' => $this->faker->paragraph(2),
          'end_notes' => $this->faker->paragraph(2),
          'word_count' => $this->faker->numberBetween(1200, 7650),
          // 'is_published' => true,
          'published_at' => now(),
          // 'revised_at' => now(),
          'created_at' => now(),
          'updated_at' => now(),
        ];
    }
}
