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
    use SuccessHandler;
    use ValidatesLotUniqueness;

    /**
     * O Lote que será atualizado.
     *
     * @var Lot
     */
    public Lot $lot;

    /**
     * Mensagem de sucesso.
     *
     * @var string
     */
    public string $successMessage;

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
        // Realiza a validação dos dados
        $this->validate();
        if ($this->validateLotUniqueness($this->lot->allotment_id, true)) {

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
