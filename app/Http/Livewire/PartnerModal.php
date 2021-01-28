<?php

namespace App\Http\Livewire;

use App\Enums\CivilStatus;
use App\Models\Person;
use App\Models\PersonDetail;
use BenSampo\Enum\Rules\EnumValue;
use Livewire\Component;
use Illuminate\Support\Facades\DB;

class PartnerModal extends Component
{
    use PersonFormDefinition;

    public bool $showModal = false;

    /**
     * O texto a ser usado no botão e no título do modal
     *
     * @var string
     */
    public string $buttonText = '';

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
        if ($this->person->detail) {
            $this->detail = $this->person->detail;
            $this->state['birth'] = $this->detail->birth_date->format('d/m/Y');
        } else {
            $this->detail = new PersonDetail();
        }
    }

    /**
     * Salva o cônjuge
     *
     * @throws \Exception
     */
    public function savePartner()
    {
        $this->validate(
            [
                'person.firstname' => ['required', 'min:5'],
                'person.lastname' => ['required', 'min:5'],
                'person.cpf' => ['required', 'numeric', 'cpf'],
                'person.phone' => ['required', 'regex:/^(\(?\d{2}\)?\s?)(\d{4,5}[\-\s]?\d{4})$/'],
                'detail.civil_status' => ['required', new EnumValue(CivilStatus::class, false)],
                'state.birth' => ['required', 'date_format:d/m/Y'],
                'detail.birth_location' => ['required', 'min:5'],
                'detail.nationality' => ['required', 'min:5'],
                'detail.rg' => ['required', 'min:3'],
                'detail.rg_issuer' => ['required', 'min:3'],
                'detail.occupation' => ['required', 'min:5'],
                'detail.email' => ['required', 'email:strict,dns,spoof'],
                'detail.monthly_income' => ['required', 'regex:/^[1-9]\d*(\.\d{3})?(\,\d{1,2})?$/'],
                'detail.father_name' => ['required', 'min:5'],
                'detail.mother_name' => ['required', 'min:5'],
            ],
            [
                'person.firstname.required' => 'O campo primeiro nome é obrigatório.',
                'person.firstname.min' => 'O campo primeiro nome deve conter no mínimo 5 caracteres.',
                'person.lastname.required' => 'O campo sobrenome é obrigatório.',
                'person.lastname.min' => 'O campo sobrenome deve conter no mínimo 5 caracteres.',
                'person.cpf.required' => 'O campo CPF é obrigatório.',
                'person.cpf.numeric' => 'O campo CPF deve conter apenas números.',
                'person.cpf.cpf' => 'Digite um CPF válido.',
                'person.phone.required' => 'O campo telefone é obrigatório.',
                'person.phone.regex' => 'Digite um número de telefone válido, incluindo o DDD.',
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
                'detail.father_name.required' => 'O campo Nome do pai é obrigatório.',
                'detail.father_name.min' => 'O campo Nome do pai deve conter no mínimo 5 caracteres.',
                'detail.mother_name.required' => 'O campo Nome da mãe é obrigatório.',
                'detail.mother_name.min' => 'O campo Nome da mãe deve conter no mínimo 5 caracteres.',
            ],
        );
        $this->validateCpfUniqueness();
        $this->detail->birth_date = $this->state['birth'];

        DB::beginTransaction();

        try {
            $this->person->save();
            $this->person->saveDetail($this->detail);
            DB::commit();
            $this->emit('partnerRegistered', $this->person->id);
            $this->showModal = false;
        } catch (\Exception $e) {
            DB::rollBack();
            throw $e;
        }
    }

    public function render()
    {
        return view('livewire.partner-modal');
    }
}
