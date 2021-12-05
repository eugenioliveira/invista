<?php

namespace App\Events;

use App\Models\Sale;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class LotSold
{
    use Dispatchable, SerializesModels;

    /**
     * A venda recém realizada
     *
     * @var Sale
     */
    public Sale $sale;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct(Sale $sale)
    {
        $this->sale = $sale;
    }
}
