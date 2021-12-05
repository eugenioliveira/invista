<?php

namespace App\Mail;

use App\Models\Proposal;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class SendProposalCreatedEmail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * A proposta recém criada
     *
     * @var Proposal
     */
    public Proposal $proposal;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(Proposal $proposal)
    {
        $this->proposal = $proposal;
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
            ->subject('Nova proposta criada')
            ->markdown('emails.proposals.created');
    }
}
