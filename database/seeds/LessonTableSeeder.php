<?php

use Illuminate\Database\Seeder;

class LessonTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(\App\Models\Lesson::class, 200)->create()->each(function($lesson){
            $lesson->course()->associate(\App\Models\Course::all()->random(1)->first());
            $lesson->save();
        });
    }
}
