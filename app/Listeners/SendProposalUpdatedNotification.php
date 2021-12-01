<?php

namespace App\Listeners;

use App\Events\ProposalUpdated;
use App\Mail\SendProposalUpdatedEmail;
use App\Models\Role;
use Mail;

class SendProposalUpdatedNotification
{
    /**
     * Handle the event.
     *
     * @param  \App\Events\ProposalUpdated  $event
     * @return void
     */
    public function handle(ProposalUpdated $event)
    {
        $adminUsers = Role::whereName('admin')->first()->users;
        Mail::to($adminUsers)->send(new SendProposalUpdatedEmail($event->proposal));
    }
}
