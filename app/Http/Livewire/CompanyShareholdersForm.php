<?php

namespace App\Http\Livewire;

use App\Actions\Company\UpdateCompanyShareholders;
use App\Models\Company;
use App\Models\Person;
use Illuminate\Support\Collection;
use Livewire\Component;

class CompanyShareholdersForm extends Component
{
    use RedirectHandler;

    /**
     * A pessoa jurídica que terá seus sócios gerenciados
     *
     * @var Company
     */
    public Company $company;

    /**
     * Os sócios selecionados e/ou existentes
     *
     * @var Collection
     */
    public Collection $shareholders;

    /**
     * Event listeners
     *
     * @var string[]
     */
    protected $listeners = ['personSelected' => 'addShareholder'];

    /**
     * Inicializa o componente
     *
     * @param Company $company
     */
    public function mount(Company $company)
    {
        $this->company = $company;
        $this->shareholders = $this->company->shareholders;
    }

    /**
     * Remove um sócio da lista.
     *
     * @param $key
     */
    public function removeShareholder($key)
    {
        $this->emit('personRemoved', $this->shareholders->get($key)->id);
        $this->shareholders->forget($key);
    }

    /**
     * Adiciona um sócio à lista.
     *
     * @param $shareholderId
     */
    public function addShareholder($shareholderId)
    {
        $this->shareholders->push(Person::findOrFail($shareholderId));
    }

    /**
     * Atualiza os sócios da empresa.
     *
     * @param UpdateCompanyShareholders $updater
     * @param bool $redirectAfterUpdate
     */
    public function updateShareholders(UpdateCompanyShareholders $updater, $redirectAfterUpdate = true)
    {
        $updater->update($this->company, $this->shareholders);

        // Redireciona
        $this->successAction('Sócios salvos.', ['companies.index'], $redirectAfterUpdate);
    }

    public function render()
    {
        return view('livewire.company-shareholders-form');
    }
}
