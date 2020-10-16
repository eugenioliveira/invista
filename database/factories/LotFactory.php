<?php

namespace Database\Factories;

use App\Models\Lot;
use Illuminate\Database\Eloquent\Factories\Factory;

class LotFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Lot::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        static $number = 1;
        if ($number > 10) {
            $number = 1;
        }

        return [
            'block' => $this->faker->randomElement(['A', 'B', 'C']),
            'number' => $number++,
            'price' => $this->faker->randomFloat(2, 10000, 100000),
            'front' => $this->faker->randomFloat(2, 10, 500),
            'back' => $this->faker->randomFloat(2, 10, 500),
            'right' => $this->faker->randomFloat(2, 10, 500),
            'left' => $this->faker->randomFloat(2, 10, 500),
            'front_side' => $this->faker->randomElement($this->streetOrLot()),
            'back_side' => $this->faker->randomElement($this->streetOrLot()),
            'right_side' => $this->faker->randomElement($this->streetOrLot()),
            'left_side' => $this->faker->randomElement($this->streetOrLot()),
        ];
    }

    private function streetOrLot() {
        return [
            "Lote " . $this->faker->randomElement(['A', 'B', 'C']) . $this->faker->numberBetween(1, 50),
            $this->faker->streetAddress
        ];
    }
}
