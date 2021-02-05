<?php

namespace App\Http\Controllers;

use App\Models\Company;

class CompaniesController extends Controller
{
    /**
     * Exibe uma listagem de pessoas jurídicas cadastradas.
     */
    public function index()
    {
        return view('companies.index');
    }

    /**
     * Exibe um formulário de cadastro de pessoa jurídica.
     */
    public function create()
    {
        return view('companies.create');
    }

    /**
     * Exibe um formulário de edição de pessoa jurídica.
     *
     * @param Company $company
     * @return \Illuminate\Contracts\View\View
     */
    public function edit(Company $company)
    {
        return view('companies.edit', ['company' => $company]);
    }
}
