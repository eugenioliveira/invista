<?php

namespace App\Actions\Proposal;

use App\Enums\ProposalStatusType;
use App\Models\Proposal;

class ResolveProposalFactory
{
    /**
     * @param ProposalStatusType $status
     * @return ResolveProposalAction
     */
    public function make(ProposalStatusType $status): ResolveProposalAction
    {
        $className = '\\App\\Actions\Proposal\\' . \Str::ucfirst(\Str::camel(\Str::lower($status->key))) . 'ProposalAction';
        if (class_exists($className)) {
            return new $className;
        }
    }
}