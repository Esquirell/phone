<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class PhoneFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $code_operators = [50, 67, 63, 68];
        $key = array_rand($code_operators);
        return [
            'number' => '+380'
                .$code_operators[$key]
                .$this->faker
                    ->randomNumber(7,true),
            'balance' => $this->faker->numberBetween(-5000, 15000)/100,
            'code' => $code_operators[$key]
        ];
    }
}
