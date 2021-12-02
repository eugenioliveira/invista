<?php

namespace App\Http\Controllers;

use App\Models\Sale;
use Illuminate\Http\Request;

class SalesController extends Controller
{
    public function index()
    {
        return view('sales.index');
    }

    public function edit(Sale $sale)
    {
        return view('sales.edit', ['sale' => $sale]);
    }

    public function store(Request $request, Sale $sale)
    {
        $validated = $request->validate([
            'contract' => 'required|file|mimetypes:application/pdf'
        ]);

        $path = \Storage::disk('documents')->putFile('/', $request->file('contract'));

        $sale->contract = $path;
        $sale->save();

        return redirect()->route('sales.index')->with('successMessage', 'Documento adicionado com sucesso.');
    }
}
