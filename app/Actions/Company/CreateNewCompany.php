<?php


namespace App\Actions\Company;


use App\Models\Company;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class CreateNewCompany
{
    /**
     * Cria uma nova pessoa jurídica na base de dados.
     *
     * @param array $input
     * @param bool $persist
     * @return Company
     * @throws \Illuminate\Validation\ValidationException
     */
    public function create(array $input, bool $persist = true)
    {
        $companyData = Validator::make($input, [
            'name' => ['required', 'min:3'],
            'cnpj' => ['required', 'numeric', 'cnpj', Rule::unique('companies', 'cnpj')],
            'state_reg_id' => ['required', 'numeric'],
            'phone' => ['required', 'regex:/^(\(?\d{2}\)?\s?)(\d{4,5}[\-\s]?\d{4})$/'],
        ])->validate();

        $companyData['creator_id'] = Auth::user()->id;

        return $persist ? Company::create($companyData) : new Company($companyData);
    }
}