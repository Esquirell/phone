<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
         \App\Models\User::factory(100)->create()->each(function ($user) {
                $user->phones()->saveMany(\App\Models\Phone::factory(rand(1,3))->make());
         });
    }
}