<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class RecordFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'wpm' => $this->faker->numberBetween(10, 250),
            'accuracy' => $this->faker->numberBetween(0, 100),
            'user_id' => 1
        ];
    }
}
