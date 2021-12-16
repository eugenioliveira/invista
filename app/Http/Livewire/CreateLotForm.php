<?php

namespace App\Http\Livewire;

use App\Enums\LotStatusType;
use App\Models\Allotment;
use App\Models\Lot;
use Illuminate\Validation\Rule;
use Livewire\Component;

/**
 * Componente responsável por criar um novo
 * Lote no sistema.
 *
 * Para criar um novo lote, é necessário saber para qual
 * loteamento esse lote será associado. Por isso, é necessário receber
 * essa informação por parâmetro.
 *
 * @package App\Http\Livewire
 */
class CreateLotForm extends Component
{
    use RedirectHandler;
    use ValidatesLotUniqueness;

    /**
     * O loteamento para o qual salvar o lote.
     *
     * @var Allotment $allotment
     */
    public Allotment $allotment;

    /**
     * O Lote que será criado.
     *
     * @var Lot
     */
    public Lot $lot;

    /**
     * O status escolhido pelo usuário
     * como status inicial do lote.
     *
     * @var int
     */
    public int $statusType;

    /**
     * Inicialização do formulário.
     *
     * @param Allotment $allotment
     */
    public function mount(Allotment $allotment)
    {
        $this->allotment = $allotment;
        $this->lot ??= new Lot();
        $this->statusType = LotStatusType::AVAILABLE;
    }

    /**
     * Realiza validação em tempo real.
     *
     * @param $propertyName
     * @throws \Illuminate\Validation\ValidationException
     */
    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }

    /**
     * Realiza a validação da Quadra em tempo real.
     */
    public function updatedLotBlock()
    {
        $this->validateLotUniqueness($this->allotment->id);
    }

    /**
     * Realiza a validação da número do lote em tempo real.
     */
    public function updatedLotNumber()
    {
        $this->validateLotUniqueness($this->allotment->id);
    }

    /**
     * Regras de validação
     *
     * @return array
     */
    public function rules()
    {
        return [
            'lot.block' => ['required', 'max:3'],
            'lot.number' => ['required', 'numeric'],
            'lot.price' => ['required', 'regex:/^[1-9]\d*(\.\d{3})?(\,\d{1,2})?$/'],
            'lot.total' => ['required', 'regex:/^[1-9]\d*(\,\d{1,2})?$/'],
            'lot.curve' => ['nullable', 'regex:/^[1-9]\d*(\,\d{1,2})?$/'],
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
            'lot.total.required' => 'O campo metragem total é obrigatório.',
            'lot.total.regex' => 'O campo metragem total deve ser um valor numérico superior a zero.',
            'lot.curve.required' => 'O campo metragem de curvatura é obrigatório.',
            'lot.curve.regex' => 'O campo metragem de curvatura deve ser um valor numérico superior a zero.',
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
            'lot.statusType.required' => 'Selecione um dos status iniciais.',
            'lot.statysType.in' => 'O campo Status inicial é inválido.'
        ];
    }

    /**
     * Cria um novo lote.
     *
     * @param bool $redirectAfterSave
     */
    public function createNewLot(bool $redirectAfterSave = true)
    {
        if ($this->validateLotUniqueness($this->allotment->id)) {
            // Realiza a validação do restante dos campos
            $this->validate();

            // Cria o lote
            $this->allotment->createLot($this->lot, $this->statusType);

            // Redireciona
            $this->successAction('Lote salvo.', ['lots.index', $this->allotment->id], $redirectAfterSave);
        }
    }

    public function render()
    {
        return view('livewire.create-lot-form');
    }
}
