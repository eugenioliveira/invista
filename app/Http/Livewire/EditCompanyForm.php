<?php

namespace App\Http\Livewire;

use App\Actions\Company\UpdateCompany;
use App\Models\Company;
use Livewire\Component;

class EditCompanyForm extends Component
{
    use RedirectHandler;

    /**
     * Controle de estado do componente.
     *
     * @var array
     */
    public array $state = [];

    /**
     * A empresa a ser atualizada
     *
     * @var Company
     */
    public Company $company;

    /**
     * Inicia o componente
     *
     * @param Company $company
     */
    public function mount(Company $company)
    {
        $this->company = $company;
        $this->state = $company->toArray();
    }

    /**
     * Atualiza as informações da empresa.
     *
     * @param UpdateCompany $updater
     * @param bool $redirectAfterUpdate
     */
    public function updateCompany(UpdateCompany $updater, $redirectAfterUpdate = true)
    {
        $this->resetErrorBag();

        $updater->update($this->company, $this->state);

        $this->successAction('Pessoa jurídica salva.', ['companies.index'], $redirectAfterUpdate);
    }

    public function render()
    {
        return view('livewire.edit-company-form');
    }
}
