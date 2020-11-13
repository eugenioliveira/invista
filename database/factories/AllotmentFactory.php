<?php

namespace Database\Factories;

use App\Models\Allotment;
use App\Models\City;
use Illuminate\Database\Eloquent\Factories\Factory;

class AllotmentFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Allotment::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'title' => $this->faker->streetName,
            'cover' => null,
            'city_id' => City::all()->random()->id,
            'active' => $this->faker->boolean,
            'area'=> app('decimal')->format($this->faker->randomFloat(2, 8, 150)),
            'latitude' => $this->faker->latitude,
            'longitude' => $this->faker->longitude,
            'max_discount' => app('decimal')->format($this->faker->randomFloat(1, 10, 20)),
            'allowable_margin' => app('decimal')->format($this->faker->randomFloat(1, 0, 5)),
            'reservation_duration' => $this->faker->randomNumber(2),
            'assurance_parcels' => $this->faker->numberBetween(0, 3)
        ];
    }
}
