<?php

use Illuminate\Database\Seeder;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        factory(App\Models\User::class, 5)->create();

        $user = \App\Models\User::find(1);

        $user->is_admin = 1;

        $user->save();
    }
}
