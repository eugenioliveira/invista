<?php


namespace App\Actions\Address;


use App\Contracts\AddressApi;
use Illuminate\Support\Facades\Validator;

class GetAddressFromApi
{
    /**
     * A API utilizada para buscar o endereço
     *
     * @var AddressApi
     */
    private AddressApi $api;

    /**
     * GetAddressFromApi constructor.
     * @param AddressApi $api
     */
    public function __construct(AddressApi $api)
    {
        $this->api = $api;
    }

    /**
     * Valida o CEP informado e realiza consulta à API.
     *
     * @param array $input
     * @return mixed
     * @throws \Illuminate\Validation\ValidationException
     */
    public function get(array $input)
    {
        Validator::make($input, [
            'postal_code' => ['required', 'numeric', 'digits:8']
        ])->validate();

        return $this->api->getAddress($input['postal_code']);
    }
}