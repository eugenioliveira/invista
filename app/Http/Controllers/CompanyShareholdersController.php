<?php

namespace App\Http\Controllers;


use App\Models\Company;

class CompanyShareholdersController extends Controller
{

    public function __invoke(Company $company)
    {
        return view('company.shareholders', ['company' => $company]);
    }
}
