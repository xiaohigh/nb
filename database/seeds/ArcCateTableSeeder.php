<?php

use Illuminate\Database\Seeder;

class ArcCateTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\Models\ArcCate::class, 5)->create();
    }
}
