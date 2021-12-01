<?php

namespace App\View\Components;

use App\Enums\LotStatusType;
use App\Enums\ProposalStatusType;
use Illuminate\View\Component;

class ProposalStatusBadge extends Component
{
    /**
     * O Status que será exibido.
     *
     * @var ProposalStatusType
     */
    public ProposalStatusType $status;

    /**
     * As classes CSS que serão aplicadas aos componentes
     *
     * @var string
     */
    public string $classes = '';

    /**
     * A descrição do status
     *
     * @var string
     */
    public string $reason;

    /**
     * Create a new component instance.
     *
     * @param ProposalStatusType $status
     */
    public function __construct(ProposalStatusType $status, string $reason)
    {
        $this->status = $status;
        $this->classes = $this->selectClasses($status);
        $this->reason = $reason;
    }

    /**
     * Aplica as classes CSS baseadas em cada status.
     *
     * @param ProposalStatusType $type
     * @return string
     */
    private function selectClasses(ProposalStatusType $type): string
    {
        switch ($type->value) {
            case ProposalStatusType::ACCEPTED:
                return 'bg-green-100 text-green-800';
            case ProposalStatusType::UNDER_REVIEW:
                return 'bg-yellow-100 text-yellow-800';
            case ProposalStatusType::RETURNED:
                return 'bg-gray-100 text-gray-800';
            default:
                // ProposalStatusType::DENIED
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
        return view('components.proposal-status-badge');
    }
}
