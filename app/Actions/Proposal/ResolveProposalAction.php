<?php

namespace App\Actions\Proposal;

use App\Models\Proposal;

interface ResolveProposalAction
{
    public function resolve(Proposal $proposal, string $reason);
}