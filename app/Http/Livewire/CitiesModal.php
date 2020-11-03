<?php

namespace App\Http\Livewire;

use App\Models\City;
use Livewire\Component;

class CitiesModal extends Component
{
    /**
     * O nome da cidade.
     *
     * @var string|null
     */
    public ?string $name = null;

    /**
     * O nome do estado.
     *
     * @var string|null
     */
    public ?string $state = null;

    /**
     * O estado do modal.
     *
     * @var bool
     */
    public bool $showModal = false;


    /**
     * Retorna as regras de validação
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => ['required', 'min:5', 'regex:/^[^0-9]+$/', 'unique:cities,name,NULL,id,state,' . $this->state],
            'state' => ['required', 'min:2', 'regex:/^[^0-9]+$/', 'unique:cities,state,NULL,id,name,' . $this->name]
        ];
    }

    /**
     * Mensagens de erro
     *
     * @var array
     */
    protected array $messages = [
        'name.required' => 'O campo cidade é obrigatório.',
        'name.min' => 'O campo cidade deve possuir no mínimo 5 caracteres.',
        'name.regex' => 'Digite um nome de cidade válido.',
        'name.unique' => 'Essa cidade já está cadastrada.',
        'state.required' => 'O campo estado é obrigatório.',
        'state.min' => 'O campo estado deve possuir no mínimo 2 caracteres.',
        'state.regex' => 'Digite um estado válido.',
        'state.unique' => 'Essa cidade já está cadastrada.'
    ];

    /**
     * Adiciona uma cidade à base de dados.
     */
    public function addCity()
    {
        $this->validate();

        $city = City::create([
            'name' => $this->name,
            'state' => $this->state
        ]);

        $this->emit('cityAdded', $city->id);
        $this->showModal = false;
        $this->resetForm();
    }

    /**
     * Reinicia o formulário
     */
    public function resetForm()
    {
        $this->resetErrorBag();
        $this->reset();
    }

    /**
     * Renderiza o componente
     *
     * @return Illuminate\Contracts\View\View|\Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function render()
    {
        return view('livewire.cities-modal');
    }
}
