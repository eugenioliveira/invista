<?php

namespace App\Exceptions;

use Exception;

class ExistingActiveReservationException extends Exception
{
    public function report()
    {
    }

    public function render()
    {
        abort(403, $this->getMessage());
    }
}
