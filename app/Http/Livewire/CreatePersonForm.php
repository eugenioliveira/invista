<?php

namespace App\Http\Livewire;

use App\Enums\CivilStatus;
use App\Models\Address;
use App\Models\Person;
use App\Models\PersonDetail;
use BenSampo\Enum\Rules\EnumValue;
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
     * O estado do formulário
     *
     * @var array
     */
    public array $state = [
        'birth' => '',
        'partner_cpf' => '',
        'show_partner_button' => false,
        'no_partner_message' => 'Nenhum cônjuge cadastrado.'
    ];

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
     * @param Address $address
     */
    public function mount(Person $person, Address $address)
    {
        // Atribui a pessoa atual
        $this->person = $person;
        // Atribui os detalhes da pessoa atual
        $this->detail = new PersonDetail();
        // Atribui o endereço da pessoa atual
        $this->address = $address;
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
            'address.postal_code' => ['required', 'numeric', 'digits:8'],
            'detail.civil_status' => ['required', new EnumValue(CivilStatus::class)],
            'state.birth' => ['required', 'date_format:d/m/Y'],
            'detail.birth_location' => ['required', 'min:5'],
            'detail.nationality' => ['required', 'min:5'],
            'detail.rg' => ['required', 'min:3'],
            'detail.rg_issuer' => ['required', 'min:3'],
            'detail.occupation' => ['required', 'min:5'],
            'detail.email' => ['required', 'email:strict,dns,spoof'],
            'detail.monthly_income' => ['required', 'regex:/^[1-9]\d*(\.\d{3})?(\,\d{1,2})?$/'],
            'state.partner_cpf' => ['numeric', 'cpf'],
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
            'address.postal_code.digits' => 'O campo CEP deve conter 8 números.',
            'detail.civil_status.required' => 'O campo estado civil é obrigatório.',
            'state.birth.required' => 'O campo data de nascimento é obrigatório.',
            'state.birth.date_format' => 'Digite uma data válida.',
            'detail.birth_location.required' => 'O campo naturalidade é obrigatório.',
            'detail.birth_location.min' => 'O campo naturalidade deve conter no mínimo 5 caracteres.',
            'detail.nationality.required' => 'O campo nacionalidade é obrigatório.',
            'detail.nationality.min' => 'O campo nacionalidade deve conter no mínimo 5 caracteres.',
            'detail.rg.required' => 'O campo rg é obrigatório.',
            'detail.rg.min' => 'O campo rg deve conter no mínimo 3 caracteres.',
            'detail.rg_issuer.required' => 'O campo Órgão emissor é obrigatório.',
            'detail.rg_issuer.min' => 'O campo Órgão emissor deve conter no mínimo 3 caracteres.',
            'detail.occupation.required' => 'O campo profissão é obrigatório.',
            'detail.occupation.min' => 'O campo profissão deve conter no mínimo 5 caracteres.',
            'detail.email.required' => 'Digite um endereço de e-mail.',
            'detail.email.email' => 'Digite um endereço de e-mail válido.',
            'detail.monthly_income.required' => 'O campo Renda mensal é obrigatório.',
            'detail.monthly_income.regex' => 'O campo Renda mensal deve ser um valor numérico superior a zero.',
            'state.partner_cpf.numeric' => 'O campo CPF deve conter apenas números.',
            'state.partner_cpf.cpf' => 'Digite um CPF válido.',
        ];
    }

    /**
     * Busca o endereço da pessoa em uma fonte externa.
     */
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

    public function savePerson()
    {
        $this->validate();
        $this->detail->birth_date = $this->state['birth'];
    }

    public function addPartner()
    {
        $this->validateOnly('state.partner_cpf');

        if ($this->state['partner_cpf']) {
            $partner = Person::firstWhere('cpf', $this->state['partner_cpf']);
            if ($partner) {
                if ($partner->id === $this->person->id) {
                    $this->addError('state.partner_cpf', 'A pessoa não pode ser cônjuge de si mesma.');
                } else {
                    $this->detail->partner = $partner;
                }
            } else {
               $this->addError('state.partner_cpf', 'Nenhuma pessoa encontrada com o CPF informado.');
            }
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
