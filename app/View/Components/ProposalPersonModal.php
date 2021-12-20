<?php

namespace App\View\Components;

use Illuminate\View\Component;

class ProposalPersonModal extends Component
{
    public string $title;
    public string $formAction;
    public string $buttonText;
    public string $modalFlag;
    public bool $address;
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($title, $formAction, $buttonText, $modalFlag, $address)
    {
        $this->title = $title;
        $this->formAction = $formAction;
        $this->buttonText = $buttonText;
        $this->modalFlag = $modalFlag;
        $this->address = $address;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.proposal-person-modal');
    }
}
