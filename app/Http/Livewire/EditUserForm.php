<?php

namespace App\Http\Livewire;

use App\Models\Role;
use App\Models\User;
use App\Models\UserDetail;
use Illuminate\Validation\Rule;
use Livewire\Component;
use Validator;

class EditUserForm extends Component
{
    use RedirectHandler;

    /**
     * O usuário a ser salvo
     *
     * @var User
     */
    public User $user;

    /**
     * Informações adicionais do usuário
     *
     * @var UserDetail
     */
    public UserDetail $detail;

    /**
     * Controla o estado da senha do usuário.
     *
     * @var array
     */
    public array $passwordState = [
        'password' => '',
        'password_confirmation' => ''
    ];

    /**
     * O papel escolhido para o usuário
     *
     * @var int
     */
    public int $roleId;

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
            'passwordState.password' => ['nullable', 'min:8', 'confirmed'],
            'detail.cpf' => ['required', 'numeric', 'cpf'],
            'detail.phone' => ['required', 'regex:/^\(?\d{2}\)?\s?\d{5}[\-\s]?\d{4}$/'],
            'detail.address' => ['required', 'min:10']
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
            'passwordState.password.confirmed' => 'Os campos senha e confirmação de senha não coincidem.',
            'detail.cpf.numeric' => 'O CPF deve conter apenas números.',
            'detail.cpf.cpf' => 'Por favor, digite um CPF válido.',
            'detail.phone.regex' => 'Digite um número de telefone (com DDD) válido.',
            'detail.address.min' => 'O endereço completo deve possuir no mínimo 10 caracteres.'
        ];
    }

    /**
     * Prepara o componente.
     *
     * @param User $user
     */
    public function mount(User $user)
    {
        // Atribui o usuário atual
        $this->user = $user;
        // Atribui os detalhes do usuário
        $this->detail = $this->user->detail ?? new UserDetail();
        // Atribui o papel atual do usuário
        $this->roleId = $user->roles->isNotEmpty() ? $user->roles()->first()->id : 3;
    }

    /**
     * Salva as informações do usuário.
     *
     * @param bool $redirectAfterSave
     */
    public function saveUser($redirectAfterSave = true)
    {
        // Valida
        $this->validate();
        $this->validateEmailUniqueness();

        // Salva o usuário
        if ($this->user->save()) {
            $this->user->detail()->save($this->detail);
            $this->user->assignRole(Role::findOrFail($this->roleId));
        }

        // Redireciona
        $this->successAction('Usuário salvo.', ['users.index'], $redirectAfterSave);
    }

    /**
     * Renderiza.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function render()
    {
        return view('livewire.edit-user-form');
    }

    /**
     * Validação do campo de e-mail
     */
    protected function validateEmailUniqueness()
    {
        $emailValidator = Validator::make(
            ['email' => $this->user->email],
            ['email' => Rule::unique('users', 'email')->ignore($this->user->id)],
            ['email.unique' => 'O e-mail acima já existe na base de dados.']
        );

        if ($emailValidator->fails()) $this->addError('user.email', $emailValidator->errors()->first('email'));
    }
}
