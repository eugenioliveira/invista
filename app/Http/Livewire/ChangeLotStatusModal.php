<?php

namespace App\Http\Livewire;

use App\Enums\LotStatusType;
use App\Models\Lot;
use Livewire\Component;

class ChangeLotStatusModal extends Component
{
    /**
     * O lote que terá seu status alterado.
     *
     * @var Lot
     */
    public Lot $lot;

    /**
     * O status a ser salvo.
     *
     * @var int
     */
    public int $status = LotStatusType::AVAILABLE;

    /**
     * A justificativa para alteração do status.
     *
     * @var string
     */
    public string $reason = '';

    /**
     * O estado do modal.
     *
     * @var bool
     */
    public bool $showModal = false;

    public function rules()
    {
        return [
            'status' => ['required'],
            'reason' => ['required', 'min:5']
        ];
    }

    public function messages()
    {
        return [
            'status.required' => 'O campo status é obrigatório.',
            'reason.required' => 'Digite uma justificativa para a mudança de status.',
            'reason.min' => 'Justificativa muito curta.'
        ];
    }

    public function changeStatus()
    {
        $this->validate();

        $this->lot->createStatus(\Auth::user(), $this->status, $this->reason, true);

        $this->emit('lotStatusChanged');
        $this->showModal = false;
        $this->resetForm();
    }

    /**
     * Reinicia o formulário
     */
    public function resetForm()
    {
        $this->resetErrorBag();
        $this->reset(['status', 'reason']);
    }

    /**
     * Inicialização do componente
     *
     * @param Lot $lot
     */
    public function mount(Lot $lot)
    {
        $this->lot = $lot;
    }

    /**
     * Renderização do componente
     *
     * @return \Illuminate\Contracts\View\View
     */
    public function render()
    {
        return view('livewire.change-lot-status-modal');
    }
}
