<?php


namespace App\Actions\Company;


use App\Models\Company;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class UpdateCompany
{
    public function update(Company $company, array $input)
    {
        $companyData = Validator::make($input, [
            'name' => ['required', 'min:3'],
            'cnpj' => ['required', 'numeric', 'cnpj', Rule::unique('companies', 'cnpj')->ignore($company->id)],
            'state_reg_id' => ['required', 'numeric'],
            'phone' => ['required', 'regex:/^(\(?\d{2}\)?\s?)(\d{4,5}[\-\s]?\d{4})$/'],
        ])->validate();

        $company->forceFill($companyData)->save();
    }
}