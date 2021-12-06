<?php

namespace App\Listeners;

use App\Events\ProposalCreated;
use App\Mail\SendProposalCreatedEmail;
use App\Models\Role;
use Illuminate\Contracts\Queue\ShouldQueue;
use Mail;

class SendProposalCreatedNotification implements ShouldQueue
{
    /**
     * Handle the event.
     *
     * @param  \App\Events\ProposalCreated  $event
     * @return void
     */
    public function handle(ProposalCreated $event)
    {
        $adminUsers = Role::whereName('admin')->first()->users;
        Mail::to($adminUsers)->send(new SendProposalCreatedEmail($event->proposal));
    }
}
