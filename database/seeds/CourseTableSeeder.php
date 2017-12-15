<?php

use Illuminate\Database\Seeder;

class CourseTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(\App\Models\Course::class, 30)->create()->each(function($course){
            $course->tags()->sync(\App\Models\Tag::all()->random(3));
        });
    }
}
