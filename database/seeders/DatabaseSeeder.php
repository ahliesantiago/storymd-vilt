<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Work;
use App\Models\Chapter;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();
        // Work::factory(5)->create();

        // // Creates the first chapter of works
        // foreach(range(11, 17) as $index){ // the range will be changed as needed
        //   Chapter::factory()->create([
        //     'work_id' => $index,
        //     'position' => 1,
        //   ]);
        // }

        // Creates the nth chapter of a work that is only missing one more chapter
        Chapter::factory()->create([
          'work_id' => 11, // the ID will be changed as needed
          'position' => 2, // the position will be changed as needed
        ]);

        // // Creates n # of chapters (after the first) of a work
        // foreach(range(2, 3) as $position){ // the range will be changed as needed
        //   Chapter::factory()->create([
        //     'work_id' => 13, // the ID will be changed as needed
        //     'position' => $position,
        //   ]);
        // }
    }
}
