<?php

namespace App\Events;

use App\Models\Proposal;
use App\Models\ProposalStatus;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class ProposalResolved
{
    use Dispatchable, SerializesModels;

    /**
     * A proposta resolvida
     *
     * @var Proposal
     */
    public Proposal $proposal;

    /**
     * O novo status da proposta
     *
     * @var ProposalStatus
     */
    public ProposalStatus $status;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct(Proposal $proposal, ProposalStatus $status)
    {
        $this->proposal = $proposal;
        $this->status = $status;
    }
}
