<?php

namespace App\View\Components;

use App\Enums\LotStatusType;
use App\Models\LotStatus;
use Illuminate\View\Component;

class LotStatusBadge extends Component
{
    /**
     * O Status que será exibido.
     *
     * @var LotStatusType
     */
    public LotStatusType $status;

    /**
     * As classes CSS que serão aplicadas aos componentes
     *
     * @var string
     */
    public string $classes = '';

    /**
     * Create a new component instance.
     *
     * @param LotStatusType $status
     */
    public function __construct(LotStatusType $status)
    {
        $this->status = $status;
        $this->classes = $this->selectClasses($status);
    }

    /**
     * Aplica as classes CSS baseadas em cada status.
     *
     * @param LotStatusType $type
     * @return string
     */
    private function selectClasses(LotStatusType $type): string
    {
        switch ($type->value) {
            case LotStatusType::AVAILABLE:
                return 'bg-green-100 text-green-800';
            case LotStatusType::RESERVED:
                return 'bg-yellow-100 text-yellow-800';
            case LotStatusType::BLOCKED:
                return 'bg-gray-100 text-gray-800';
            default: // LotStatusType::SOLD e LotStatusType::PROPOSED
                return 'bg-red-100 text-red-800';
        }
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|string
     */
    public function render()
    {
        return view('components.lot-status-badge');
    }
}
