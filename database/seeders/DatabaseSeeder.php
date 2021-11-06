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
        /*
         * Генерация 2000 записей о пользователях
         * У каждого пользователя случайно от 1 до 3 телефонов
         */
         \App\Models\User::factory(2000)->create()->each(function ($user) {
                $user->phones()->saveMany(\App\Models\Phone::factory(rand(1,3))->make());
         });
    }
}
