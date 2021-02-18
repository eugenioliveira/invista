<?php

namespace App\Http\Controllers;

use App\Models\Company;

class CompanyAddressController extends Controller
{
    /**
     * Exibe um formulário para edição do endereço da empresa.
     *
     * @param Company $company
     * @return \Illuminate\Contracts\View\View
     */
    public function __invoke(Company $company)
    {
        return view('company.address', ['company' => $company]);
    }
}
