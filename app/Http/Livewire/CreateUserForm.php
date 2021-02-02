<?php

namespace App\Http\Livewire;

use App\Models\Address;
use App\Models\Person;
use App\Models\Role;
use App\Models\User;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Livewire\Component;

class CreateUserForm extends Component
{
    use RedirectHandler, AuthorizesRequests, ExternalAddressApi;

    /**
     * O usuário a ser salvo
     *
     * @var User
     */
    public User $user;

    /**
     * A pessoa a qual o usuário pertence
     *
     * @var Person
     */
    public Person $person;

    /**
     * O endereço do usuário
     *
     * @var Address
     */
    public Address $address;

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
     * Regras de validação
     *
     * @return array
     */
    public function rules(): array
    {
        return [
            'person.firstname' => ['required', 'min:5'],
            'person.lastname' => ['required', 'min:5'],
            'person.cpf' => ['required', 'numeric', 'cpf', 'unique:people,cpf'],
            'person.phone' => ['required', 'regex:/^(\(?\d{2}\)?\s?)(\d{4,5}[\-\s]?\d{4})$/'],
            'user.email' => ['required', 'email:strict,dns,spoof', 'unique:users,email'],
            'passwordState.password' => ['required', 'min:8', 'confirmed'],
            'address.street' => ['required', 'min:8'],
            'address.number' => ['required', 'numeric'],
            'address.apt_room' => ['nullable', 'min:3'],
            'address.neighbourhood' => ['required', 'min:5'],
            'address.city' => ['required', 'min:5'],
            'address.state' => ['required', 'min:2'],
            'address.postal_code' => ['required', 'numeric', 'digits:8']
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
            'person.firstname.required' => 'O campo primeiro nome é obrigatório.',
            'person.firstname.min' => 'O campo primeiro nome deve conter no mínimo 5 caracteres.',
            'person.lastname.required' => 'O campo sobrenome é obrigatório.',
            'person.lastname.min' => 'O campo sobrenome deve conter no mínimo 5 caracteres.',
            'person.cpf.required' => 'O campo CPF é obrigatório.',
            'person.cpf.numeric' => 'O campo CPF deve conter apenas números.',
            'person.cpf.cpf' => 'Digite um CPF válido.',
            'person.cpf.unique' => 'O CPF acima já existe na base de dados.',
            'person.phone.required' => 'O campo telefone é obrigatório.',
            'person.phone.regex' => 'Digite um número de telefone válido, incluindo o DDD.',
            'user.email.required' => 'Digite um endereço de e-mail.',
            'user.email.email' => 'Digite um endereço de e-mail válido.',
            'user.email.unique' => 'O e-mail acima já existe na base de dados.',
            'passwordState.password.required' => 'Digite uma senha para o usuário.',
            'passwordState.password.min' => 'A senha deve conter no mínimo 8 caracteres.',
            'passwordState.password.confirmed' => 'Os campos senha e confirmação de senha devem coincidir.',
            'address.street.required' => 'O campo Logradouro é obrigatório.',
            'address.street.min' => 'O campo Logradouro deve conter no mínimo 8 caracteres.',
            'address.number.required' => 'O campo número é obrigatório.',
            'address.number.numeric' => 'O campo número deve conter apenas números.',
            'address.apt_room.min' => 'O campo complemento deve conter no mínimo 3 caracteres.',
            'address.neighbourhood.required' => 'O campo bairro é obrigatório.',
            'address.neighbourhood.min' => 'O campo bairro deve conter no mínimo 5 caracteres.',
            'address.city.required' => 'O campo cidade é obrigatório.',
            'address.city.min' => 'O campo cidade deve conter no mínimo 5 caracteres.',
            'address.state.required' => 'O campo UF é obrigatório.',
            'address.state.min' => 'O campo UF deve conter 2 caracteres.',
            'address.postal_code.required' => 'O campo CEP é obrigatório.',
            'address.postal_code.numeric' => 'O campo CEP deve conter apenas números.',
            'address.postal_code.digits' => 'O campo CEP deve conter 8 números.'
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
        $this->person = new Person();
        // Atribui o endereço do usuário
        $this->address = new Address();
        // Define o papel de corretor como padrão
        $this->roleId = 3;
    }

    public function getAddressByPostalCode()
    {
        $extAddress = $this->getAddressFromExternalApi(
            $this->address->postal_code,
            'address.postal_code'
        );

        if ($extAddress) {
            $this->address->fill($extAddress);
        }
    }

    /**
     * Salva as informações do usuário.
     *
     * @param bool $redirectAfterSave
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function saveUser($redirectAfterSave = true)
    {
        // Faz a autorização
        $this->authorize('create', [User::class, $this->roleId]);

        // Valida
        $this->validate();

        // Salva a pessoa e o usuário
        if ($this->person->save()) {
            $this->person
                ->saveUser($this->user->email, $this->passwordState['password'])
                ->assignRole(Role::find($this->roleId));
            $this->person->saveAddress($this->address);
        }

        // Redireciona
        $this->successAction('Usuário salvo.', ['users.index'], $redirectAfterSave);
    }

    // Renderiza.
    public function render()
    {
        return view('livewire.user-form');
    }
}
