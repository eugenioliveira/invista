<?php

namespace App\Http\Controllers;

use App\Models\Allotment;

class AllotmentsPaymentPlansController extends Controller
{
    /**
     * Exibe um formulário para atualização dos planos de pagamento
     * do loteamento.
     *
     * @param Allotment $allotment
     * @return \Illuminate\Contracts\View\View
     */
    public function __invoke(Allotment $allotment)
    {
        return view('allotments.payment-plans', ['allotment' => $allotment]);
    }
}
