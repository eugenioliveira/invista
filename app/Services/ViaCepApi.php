<?php


namespace App\Services;


use App\Contracts\AddressApi;
use Illuminate\Support\Facades\Http;

class ViaCepApi implements AddressApi
{
    /**
     * O formato da URL para consulta
     *
     * @var string
     */
    private string $urlFormat = 'https://viacep.com.br/ws/%s/json/';

    /**
     * @inheritDoc
     */
    public function getAddress(string $postalCode)
    {
        $url = sprintf($this->urlFormat, $postalCode);
        $response = Http::get($url)->object();

        if (isset($response->erro)) {
            return false;
        } else {
            return [
                'postal_code' => preg_replace('/[^\d]/', '', $response->cep),
                'street' => $response->logradouro,
                'neighbourhood' => $response->bairro,
                'city' => $response->localidade,
                'state' => $response->uf
            ];
        }
    }
}