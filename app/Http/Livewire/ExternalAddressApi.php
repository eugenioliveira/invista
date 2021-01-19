<?php


namespace App\Http\Livewire;


use App\Models\Address;
use Illuminate\Support\Facades\Http;

trait ExternalAddressApi
{
    /**
     * @param $postalCode
     * @param $addressField
     * @return array|void
     */
    public function getAddressFromExternalApi($postalCode, $addressField)
    {
        $this->validateOnly($addressField);
        $url = sprintf('https://viacep.com.br/ws/%s/json/', $postalCode);
        $response = Http::get($url)->object();

        if (isset($response->erro)) {
            $this->addError($addressField, 'O CEP informado não existe.');
        } else {
            return [
                'street' => $response->logradouro,
                'neighbourhood' => $response->bairro,
                'city' => $response->localidade,
                'state' => $response->uf
            ];
        }
    }
}