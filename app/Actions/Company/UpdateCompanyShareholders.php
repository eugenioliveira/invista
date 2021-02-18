<?php


namespace App\Actions\Company;


use App\Models\Company;
use Illuminate\Support\Collection;

class UpdateCompanyShareholders
{
    /**
     * @param Company $company
     * @param Collection $shareholders
     * @return array
     */
    public function update(Company $company, Collection $shareholders)
    {
        return $company->shareholders()->sync($shareholders->pluck('id'));
    }
}