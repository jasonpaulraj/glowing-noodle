<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class PositionBoxFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'box_rows' => $this->faker->randomElement([4, 5, 6, 7, 8]),
            'box_columns' =>  $this->faker->randomElement([4, 5, 6, 7, 8]),
            'box_disable_rows' => json_encode([]),
            'box_disable_columns' => json_encode([])
        ];
    }
}
