<?php

namespace Database\Factories;

use App\Models\Lot;
use App\Models\Reservation;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\Factory;

class ReservationFactory extends Factory
{
    private static $order = 1;
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Reservation::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'lot_id' => Lot::pluck('id')->random(),
            'user_id' => User::pluck('id')->random(),
            'reserveable_id' => 4,
            'reserveable_type' => 'App\Models\Person',
            'init' => now()
                ->subDay()
                ->addMinutes(self::$order++),
            'due' => now()
                ->addMinutes(self::$order++)
                ->addHours(48)
        ];
    }
}
