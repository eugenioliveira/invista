<?php

namespace App\Listeners;

use App\Events\LotSold;
use App\Mail\SendLotSoldEmail;
use App\Models\Role;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Mail;

class SendLotSoldNotification
{
    /**
     * Handle the event.
     *
     * @param  \App\Events\LotSold  $event
     * @return void
     */
    public function handle(LotSold $event)
    {
        $to = Role::whereName('admin')->first()->users;
        $to->push($event->sale->user);
        Mail::to($to)->send(new SendLotSoldEmail($event->sale));
    }
}
