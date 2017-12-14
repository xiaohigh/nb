<?php

use Illuminate\Database\Seeder;

class ArticleTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\Models\Article::class, 50)->create()->each(function($article){
            $article->tags()->sync(\App\Models\Tag::all()->random(3));
        });
    }
}
