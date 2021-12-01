<?php

namespace App\Providers;

use App\Events\ProposalResolved;
use App\Listeners\SendProposalResolvedNotification;
use App\Events\ProposalCreated;
use App\Listeners\SendProposalCreatedNotification;
use App\Events\ProposalUpdated;
use App\Listeners\SendProposalUpdatedNotification;
use Illuminate\Auth\Events\Registered;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array
     */
    protected $listen = [
        Registered::class => [
            SendEmailVerificationNotification::class,
        ],
        ProposalResolved::class => [
            SendProposalResolvedNotification::class
        ],
        ProposalCreated::class => [
            SendProposalCreatedNotification::class
        ],
        ProposalUpdated::class => [
            SendProposalUpdatedNotification::class
        ]
    ];

    /**
     * Register any events for your application.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
