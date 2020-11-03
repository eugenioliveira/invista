<?php

namespace App\Http\Controllers;

use App\Models\Allotment;

class LotsImportController extends Controller
{
    public function create(Allotment $allotment)
    {
        return view('lots-import.create', [
            'allotment' => $allotment
        ]);
    }
}
