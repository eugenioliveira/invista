<?php


namespace App\Contracts;


interface AddressApi
{
    /**
     * Busca o endereço na API com o CEP informado
     *
     * @param string $postalCode
     * @return mixed
     */
    public function getAddress(string $postalCode);
}