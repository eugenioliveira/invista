<?php

namespace App\Actions\Allotment;

use App\Models\Allotment;
use Validator;

class UpdateAllotmentPaymentPlans
{
    /**
     * @throws \Illuminate\Validation\ValidationException
     */
    public function update(Allotment $allotment, array $plans)
    {
        $validatedPlans = Validator::make(['plans' => $plans], [
            'plans.*' => ['required', 'exists:App\Models\PaymentPlan,id']
        ])->validate();

        return $allotment->plans()->sync($plans);
    }
}