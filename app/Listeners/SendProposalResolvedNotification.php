<?php

namespace App\Listeners;

use App\Events\ProposalResolved;
use App\Mail\SendProposalResolvedEmail;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Mail;

class SendProposalResolvedNotification
{
    /**
     * Handle the event.
     *
     * @param \App\Events\ProposalResolved $event
     * @return void
     */
    public function handle(ProposalResolved $event)
    {
        Mail::to($event->proposal->user->email)->send(new SendProposalResolvedEmail($event->proposal, $event->status));
    }
}
