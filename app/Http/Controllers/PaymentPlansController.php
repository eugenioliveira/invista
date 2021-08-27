<?php

namespace App\Http\Controllers;

use App\Models\PaymentPlan;
use Illuminate\Http\Request;

class PaymentPlansController extends Controller
{
    public function index()
    {
        return view('payment-plans.index', ['plans' => PaymentPlan::all()]);
    }

    public function create()
    {
        return view('payment-plans.create');
    }

    public function edit(PaymentPlan $plan)
    {
        return view('payment-plans.edit', ['plan' => $plan]);
    }
}
