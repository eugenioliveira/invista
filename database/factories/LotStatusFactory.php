<?php

namespace Database\Factories;

use App\Enums\LotStatusType;
use App\Models\Lot;
use App\Models\LotStatus;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class LotStatusFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = LotStatus::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'lot_id' => Lot::all()->random()->id,
            'user_id' => User::all()->random()->id,
            'type' => $this->faker->randomElement([1,4,5]),
            'reason' => $this->faker->sentence()
        ];
    }
}
