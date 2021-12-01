<?php

namespace App\Mail;

use App\Models\Proposal;
use App\Models\ProposalStatus;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ProposalResolved extends Mailable
{
    use Queueable, SerializesModels;

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
    public ProposalStatus $proposalStatus;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(Proposal $proposal, ProposalStatus $proposalStatus)
    {
        $this->proposal = $proposal;
        $this->proposalStatus = $proposalStatus;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        foreach ($this->proposal->documents as $document) {
            $this->attachFromStorageDisk('documents', $document->filename);
        }

        return $this
            ->from('nao-responda@invista.com.br')
            ->markdown('emails.proposals.resolved');
    }
}
