<?php

namespace App\Http\Livewire;

use App\Models\User;
use Livewire\Component;

class UserForm extends Component
{
    use RedirectHandler;

    /**
     * O usuário a ser salvo
     *
     * @var User
     */
    public User $user;

    /**
     * A senha em plaintext do usuário.
     *
     * @var string
     */
    public string $password = '';

    /**
     * O papel escolhido para o usuário
     * DEFAULT: Corretor
     *
     * @var int
     */
    public int $roleId = 3;

    /**
     * Mensagem de sucesso.
     *
     * @var string|null
     */
    public ?string $successMessage = null;

    /**
     * Regras de validação
     *
     * @return array
     */
    public function rules(): array
    {
        return [
            'user.name' => ['required', 'min:5'],
            'user.email' => ['required', 'email:strict,dns,spoof'],
            'password' => ['nullable', 'min:8', 'confirmed'],
        ];
    }

    /**
     * Mensagens de erro de validação
     *
     * @return array
     */
    public function messages(): array
    {
        return [
            'user.name.required' => 'O nome de usuário completo é obrigatório.',
            'user.name.min' => 'Digite pelo menos 5 caracteres.',
            'user.email.required' => 'Digite um endereço de e-mail.',
            'user.email.email' => 'Digite um endereço de e-mail válido.',
            'password.min' => 'A senha deve conter pelo menos 8 caracteres.',
            'password.confirmed' => 'Os campos senha e confirmação de senha não coincidem.',
        ];
    }

    /**
     * Prepara o componente.
     *
     * @param User $user
     */
    public function mount(User $user)
    {
        $this->user = $user;
        if ($user->roles->isNotEmpty()) {
            $this->roleId = $user->roles()->first()->id;
        }
    }

    /**
     * Salva as informações do usuário.
     *
     * @param bool $redirectAfterSave
     */
    public function saveUser($redirectAfterSave = true)
    {
        $this->validate();
    }

    /**
     * Renderiza.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function render()
    {
        return view('livewire.user-form');
    }
}
