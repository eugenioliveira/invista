<?php


namespace App\Actions\City;


use App\Models\City;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class CreateNewCity
{
    /**
     * Cria uma nova cidade na base de dados.
     *
     * @param array $input
     * @return City
     */
    public function create(array $input)
    {
        $cityData = Validator::make($input, [
            'name' => [
                'required',
                'min:5',
                Rule::unique('cities')->where(function ($query) use ($input) {
                    return $query->where('state', $input['state']);
                })
            ],
            'state' => [
                'required',
                'size:2',
                'alpha',
                Rule::unique('cities')->where(function ($query) use ($input) {
                    return $query->where('name', $input['name']);
                })
            ]
        ])->safe()->all();

        return City::create($cityData);
    }
}