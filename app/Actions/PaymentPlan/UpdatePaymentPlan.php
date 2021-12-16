<?php

namespace App\Actions\PaymentPlan;

use App\Models\PaymentPlan;
use Validator;

class UpdatePaymentPlan
{
    public function update(PaymentPlan $plan, array $input)
    {
        $validatedPaymentPlan = Validator::make($input,
            [
                'name' => ['required', 'min:3'],
                'description' => ['required', 'min:5'],
                'min_down_payment' => ['required'],
                'installment_indexes' => ['required', 'array'],
                'installment_indexes.*' => ['required', 'array:installments,index']
            ],
            [
                'installment_indexes.*.array' => 'Array de índices inválido. Contate o desenvolvedor'
            ]
        )->validate();

        $plan->forceFill($validatedPaymentPlan)->save();
    }
}