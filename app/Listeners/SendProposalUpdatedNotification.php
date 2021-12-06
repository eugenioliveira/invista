<?php

namespace App\Listeners;

use App\Events\ProposalUpdated;
use App\Mail\SendProposalUpdatedEmail;
use App\Models\Role;
use Illuminate\Contracts\Queue\ShouldQueue;
use Mail;

class SendProposalUpdatedNotification implements ShouldQueue
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
