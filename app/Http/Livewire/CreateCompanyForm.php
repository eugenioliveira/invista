<?php

namespace App\Http\Livewire;

use App\Actions\Company\CreateNewCompany;
use Livewire\Component;

class CreateCompanyForm extends Component
{
    use RedirectHandler;

    /**
     * Controle de estado do componente.
     *
     * @var array
     */
    public array $state = [];

    /**
     * Cria a pessoa jurídica com os dados enviados.
     *
     * @param CreateNewCompany $creator
     * @param bool $redirectAfterCreate
     * @throws \Illuminate\Validation\ValidationException
     */
    public function createCompany(CreateNewCompany $creator, $redirectAfterCreate = true)
    {
        $this->resetErrorBag();

        $creator->create($this->state);

        // Redireciona
        $this->successAction('Pessoa jurídica salva.', ['companies.index'], $redirectAfterCreate);
    }

    public function render()
    {
        return view('livewire.create-company-form');
    }
}
