<?php


namespace App\Actions\Address;


use App\Services\ViaCepApi;
use Illuminate\Support\Facades\Validator;

class GetAddressFromApi
{
    public function get(array $input)
    {
        $api = new ViaCepApi();

        Validator::make($input, [
            'postal_code' => ['required', 'numeric', 'digits:8']
        ])->validate();

        return $api->getAddress($input['postal_code']);
    }
}