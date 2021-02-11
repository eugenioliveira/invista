<?php

namespace App\Http\Livewire;

use App\Models\Company;
use App\Models\Person;
use Illuminate\Database\Eloquent\Collection;
use Livewire\Component;

class CompanyShareholdersForm extends Component
{
    /**
     * A pessoa jurídica que terá seus sócios gerenciados
     *
     * @var Company
     */
    public Company $company;

    /**
     * Os sócios selecionados e/ou existentes
     *
     * @var Collection|null
     */
    public ?Collection $shareholders;

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

    public function render()
    {
        return view('livewire.company-shareholders-form');
    }
}
