<?php

namespace App\Http\Livewire;

use App\Enums\LotStatusType;
use App\Models\Allotment;
use App\Models\Lot;
use Illuminate\Validation\Rule;
use Livewire\Component;

class LotForm extends Component
{
    /**
     * O loteamento a qual o lote pertence / pertencerá.
     *
     * @var Allotment|null
     */
    public ?Allotment $allotment;

    /**
     * O lote a ser salvo.
     *
     * @var Lot
     */
    public $lot;

    /**
     * O tipo do status a ser salvo no lote.
     *
     * @var int
     */
    public int $statusType = LotStatusType::AVAILABLE;

    /**
     * Mensagem de sucesso.
     *
     * @var string|null
     */
    public ?string $successMessage = null;

    /**
     * o ID do loteamento para o qual redirecionar
     * após salvar o lote.
     *
     * @var int|null
     */
    public ?int $allotmentId;

    /**
     * Regras de validação
     *
     * @return array
     */
    public function rules() {
        return [
            'lot.block' => ['required', 'max:3'],
            'lot.number' => ['required', 'numeric'],
            'lot.price' => ['required', 'regex:/^[1-9]\d*(\.\d{3})?(\,\d{1,2})?$/'],
            'lot.front' => ['required', 'regex:/^[1-9]\d*(\,\d{1,2})?$/'],
            'lot.back' => ['required', 'regex:/^[1-9]\d*(\,\d{1,2})?$/'],
            'lot.right' => ['required', 'regex:/^[1-9]\d*(\,\d{1,2})?$/'],
            'lot.left' => ['required', 'regex:/^[1-9]\d*(\,\d{1,2})?$/'],
            'lot.front_side' => ['required', 'min:3'],
            'lot.back_side' => ['required', 'min:3'],
            'lot.right_side' => ['required', 'min:3'],
            'lot.left_side' => ['required', 'min:3'],
            'statusType' => ['required', Rule::in(LotStatusType::getValues())]
        ];
    }

    /**
     * Mensagens das regras de validação
     *
     * @return array
     */
    public function messages()
    {
        return [
            'lot.block.required' => 'A o campo Quadra é obrigatório.',
            'lot.block.max' => 'A o campo Quadra deve possuir no máximo 3 caracteres.',
            'lot.number.required' => 'A o campo Número do lote é obrigatório.',
            'lot.number.numeric' => 'A o campo Número do lote deve ser um valor numérico.',
            'lot.price.required' => 'O campo Preço é obrigatório.',
            'lot.price.regex' => 'O campo Preço deve ser um valor numérico superior a zero.',
            'lot.front.required' => 'O campo metragem de frente é obrigatório.',
            'lot.front.regex' => 'O campo metragem de frente deve ser um valor numérico superior a zero.',
            'lot.back.required' => 'O campo metragem de fundos é obrigatório.',
            'lot.back.regex' => 'O campo metragem de fundos deve ser um valor numérico superior a zero.',
            'lot.right.required' => 'O campo metragem direita é obrigatório.',
            'lot.right.regex' => 'O campo metragem direita deve ser um valor numérico superior a zero.',
            'lot.left.required' => 'O campo metragem esquerda é obrigatório.',
            'lot.left.regex' => 'O campo metragem esquerda deve ser um valor numérico superior a zero.',
            'lot.front_side.required' => 'O campo confrontação de frente é obrigatório.',
            'lot.front_side.min' => 'O campo confrontação de frente deve possuir no mínimo 3 caracteres.',
            'lot.back_side.required' => 'O campo confrontação de fundos é obrigatório.',
            'lot.back_side.min' => 'O campo confrontação de fundos deve possuir no mínimo 3 caracteres.',
            'lot.right_side.required' => 'O campo confrontação direita é obrigatório.',
            'lot.right_side.min' => 'O campo confrontação direita deve possuir no mínimo 3 caracteres.',
            'lot.left_side.required' => 'O campo confrontação esquerda é obrigatório.',
            'lot.left_side.min' => 'O campo confrontação esquerda deve possuir no mínimo 3 caracteres.',
            'statusType.required' => 'Selecione um dos status iniciais.',
            'statysType.in' => 'O campo Status inicial é inválido.'
        ];
    }

    /**
     * Prepara o componente.
     *
     * @param Allotment $allotment
     * @param Lot $lot
     */
    public function mount(Allotment $allotment, Lot $lot)
    {
        $this->allotment = $allotment;
        $this->lot = $lot;
        $this->allotmentId = ($this->allotment->id) ?? $this->lot->allotment_id;
    }

    /**
     * Indica que os campos serão validados em tempo real
     *
     * @param $propertyName
     * @throws \Illuminate\Validation\ValidationException
     */
    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }

    /**
     * Salva o lote.
     * @param bool $redirectAfterSave
     * @return \Illuminate\Http\RedirectResponse
     */
    public function submit(bool $redirectAfterSave = true)
    {
        $this->validate();

        if ($this->allotment->id) {
            $this->allotment->saveLot($this->lot);
            $this->lot->createStatus(
                \Auth::user(),
                $this->statusType,
                sprintf('Lote criado manualmente por %s.', \Auth::user()->name),
                true
            );
        } else {
            $this->lot->save();
        }

        $this->successMessage = 'Lote salvo.';

        if ($redirectAfterSave) {
            session()->flash('successMessage', $this->successMessage);
            return redirect()->route('lots.index', $this->allotmentId);
        }
    }

    public function render()
    {
        return view('livewire.lot-form');
    }
}
