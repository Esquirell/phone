<?php

namespace Database\Factories;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class UserFactory extends Factory
{
    /**
     * Создается случайное имя пользователя и случайная дата рождения
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->name(),
            'birth_date' => Carbon::now()->subYear(rand(20,70))
                ->addDay(rand(1,30))
                ->addMonth(rand(1,12))
                ->format('d-m-Y'),
        ];
    }
}
