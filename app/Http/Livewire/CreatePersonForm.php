<?php

namespace App\Http\Livewire;

use App\Models\Address;
use App\Models\Person;
use App\Models\PersonDetail;
use Livewire\Component;

class CreatePersonForm extends Component
{
    use RedirectHandler, ExternalAddressApi;

    /**
     * A pessoa a ser criada
     *
     * @var Person
     */
    public Person $person;

    /**
     * Os detalhes da pessoa a ser criada
     *
     * @var PersonDetail
     */
    public PersonDetail $detail;

    /**
     * O endereço da pessoa a ser criada
     *
     * @var Address
     */
    public Address $address;

    /**
     * Mensagem de sucesso.
     *
     * @var string|null
     */
    public ?string $successMessage = null;

    /**
     * Monta o componente.
     *
     * @param Person $person
     */
    public function mount(Person $person)
    {
        // Atribui a pessoa atual
        $this->person = $person;
        // Atribui os detalhes da pessoa atual
        $this->detail = new PersonDetail();
        // Atribui o endereço da pessoa atual
        $this->address = new Address();
    }

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
     * Renderiza o componente.
     *
     * @return \Illuminate\Contracts\View\View
     */
    public function render()
    {
        return view('livewire.person-form');
    }
}
