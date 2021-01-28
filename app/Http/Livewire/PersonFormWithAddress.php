<?php


namespace App\Http\Livewire;


use App\Models\Address;

trait PersonFormWithAddress
{
    /**
     * O endereço da pessoa a ser criada
     *
     * @var Address
     */
    public Address $address;

    /**
     * As regras de validação do endereço
     *
     * @var array
     */
    public array $addressValidationRules = [

    ];

    /**
     * As mensagens de validação do endereço
     *
     * @var array
     */
    public array $addressValidationMessages = [
        'address.street.required' => 'O campo Logradouro é obrigatório.',
        'address.street.min' => 'O campo Logradouro deve conter no mínimo 8 caracteres.',
        'address.number.required' => 'O campo número é obrigatório.',
        'address.number.numeric' => 'O campo número deve conter apenas números.',
        'address.apt_room.min' => 'O campo complemento deve conter no mínimo 3 caracteres.',
        'address.neighbourhood.required' => 'O campo bairro é obrigatório.',
        'address.neighbourhood.min' => 'O campo bairro deve conter no mínimo 5 caracteres.',
        'address.city.required' => 'O campo cidade é obrigatório.',
        'address.city.min' => 'O campo cidade deve conter no mínimo 5 caracteres.',
        'address.state.required' => 'O campo UF é obrigatório.',
        'address.state.min' => 'O campo UF deve conter 2 caracteres.',
        'address.postal_code.required' => 'O campo CEP é obrigatório.',
        'address.postal_code.numeric' => 'O campo CEP deve conter apenas números.',
        'address.postal_code.digits' => 'O campo CEP deve conter 8 números.',
    ];

    /**
     * Busca o endereço da pessoa em uma fonte externa.
     */
    public function getAddressByPostalCode()
    {
        $extAddress = $this->getAddressFromExternalApi(
            $this->address->postal_code,
            'address.postal_code'
        );

        if ($extAddress) {
            $this->address->fill($extAddress);
        }
    }
}