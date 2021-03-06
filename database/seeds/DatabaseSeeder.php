<?php

use Illuminate\Database\Seeder;


class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->call(UserTableSeeder::class);
        $this->call(ArcCateTableSeeder::class);
        $this->call(TagTableSeeder::class);
        $this->call(ArticleTableSeeder::class);
        $this->call(CourseTableSeeder::class);
        $this->call(LessonTableSeeder::class);
    }
}
