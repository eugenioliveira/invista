<?php

namespace App\Events;

use App\Models\Proposal;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class ProposalCreated
{
    use Dispatchable, SerializesModels;

    /**
     * A nova proposta criada
     *
     * @var Proposal
     */
    public Proposal $proposal;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct(Proposal $proposal)
    {
        $this->proposal = $proposal;
    }
}
