<?php

namespace App\Http\Livewire;

use App\Models\Lot;
use Livewire\Component;

/**
 * Componente responsável por editar um lote
 * no sistema.
 *
 * Recebe as informações e atualiza os dados.
 *
 * @package App\Http\Livewire
 */
class EditLotForm extends Component
{
    use RedirectHandler;
    use ValidatesLotUniqueness;

    /**
     * O Lote que será atualizado.
     *
     * @var Lot
     */
    public Lot $lot;

    /**
     * Inicialização do formulário.
     *
     * @param Lot $lot
     */
    public function mount(Lot $lot)
    {
        $this->lot = $lot;
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
        $this->validateLotUniqueness($this->lot->allotment_id);
    }

    /**
     * Realiza a validação da número do lote em tempo real.
     */
    public function updatedLotNumber()
    {
        $this->validateLotUniqueness($this->lot->allotment_id);
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
            'lot.curve' => ['required', 'regex:/^[1-9]\d*(\,\d{1,2})?$/', 'nullable'],
            'lot.front' => ['required', 'regex:/^[1-9]\d*(\,\d{1,2})?$/'],
            'lot.back' => ['required', 'regex:/^[1-9]\d*(\,\d{1,2})?$/'],
            'lot.right' => ['required', 'regex:/^[1-9]\d*(\,\d{1,2})?$/'],
            'lot.left' => ['required', 'regex:/^[1-9]\d*(\,\d{1,2})?$/'],
            'lot.front_side' => ['required', 'min:3'],
            'lot.back_side' => ['required', 'min:3'],
            'lot.right_side' => ['required', 'min:3'],
            'lot.left_side' => ['required', 'min:3']
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
            'lot.left_side.min' => 'O campo confrontação esquerda deve possuir no mínimo 3 caracteres.'
        ];
    }

    /**
     * Atualiza as informações do lote.
     *
     * @param bool $redirectAfterSave
     */
    public function updateLot(bool $redirectAfterSave = true)
    {
        if ($this->validateLotUniqueness($this->lot->allotment_id, true)) {

            // Realiza a validação dos demais campos
            $this->validate();

            // Salva o lote
            $this->lot->save();

            // Redireciona
            $this->successAction(
                'Lote salvo.',
                ['lots.index', $this->lot->allotment_id],
                $redirectAfterSave
            );
        }
    }

    public function render()
    {
        return view('livewire.edit-lot-form');
    }
}
