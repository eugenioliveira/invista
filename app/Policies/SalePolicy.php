<?php

namespace App\Policies;

use App\Models\Lot;
use App\Models\Sale;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class SalePolicy
{
    use HandlesAuthorization;

    /**
     * Create a new policy instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    public function create(User $loggedUser, Lot $lot)
    {
        return !$lot->sale instanceof Sale;
    }
}
