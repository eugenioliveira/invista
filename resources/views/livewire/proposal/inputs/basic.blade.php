<div>
    <div class="flex justify-center mb-2 space-x-2 items-end">
        <x-input.group :inline="true" for="cpf" label="CPF" :error="$errors->first('cpf')">
            <x-input.text wire:model.lazy="state.cpf" id="cpf" x-ref="cpf"
                          placeholder="Número de CPF" />
        </x-input.group>
        <x-button wire:click="findPersonByCPF" type="button">Preencher</x-button>
    </div>

    <x-input.group for="first_name" label="Primeiro nome" :error="$errors->first('first_name')">
        <x-input.text wire:model.lazy="state.first_name" id="first_name"
                      placeholder="Digite o primeiro nome do proponente" />
    </x-input.group>

    <x-input.group for="last_name" label="Sobrenome" :error="$errors->first('last_name')">
        <x-input.text wire:model.lazy="state.last_name" id="last_name"
                      placeholder="Digite o sobrenome do proponente" />
    </x-input.group>

    <x-input.group for="phone" label="Telefone" :error="$errors->first('phone')">
        <x-input.text wire:model.lazy="state.phone" id="phone"
                      placeholder="Digite o telefone do proponente" />
    </x-input.group>

    <x-input.group for="civil_status" label="Estado civil">
        <x-input.select wire:model.lazy="state.civil_status" id="civil_status">
            <option value="" disabled>Selecione...</option>

            @foreach (\App\Enums\CivilStatus::getInstances() as $status)
                <option value="{{ $status->value }}">{{ $status->description }}</option>
            @endforeach
        </x-input.select>
    </x-input.group>

    <x-input.group for="birth_date" label="Data de nascimento">
        <x-input.date wire:model.lazy="state.birth_date" id="birth_date"
                      placeholder="DD/MM/AAAA" />
    </x-input.group>

    <x-input.group for="birth_location" label="Naturalidade" :error="$errors->first('birth_location')">
        <x-input.text wire:model.lazy="state.birth_location" id="birth_location"
                      placeholder="Cidade - UF" />
    </x-input.group>

    <x-input.group for="nationality" label="Nacionalidade" :error="$errors->first('nationality')">
        <x-input.text wire:model.lazy="state.nationality" id="nationality"
                      placeholder="Digite a nacionalidade do proponente" />
    </x-input.group>

    <x-input.group for="rg" label="RG" :error="$errors->first('rg')">
        <x-input.text wire:model.lazy="state.rg" id="rg" placeholder="Digite o RG do proponente" />
    </x-input.group>

    <x-input.group for="rg_issue_date" label="Data de emissão RG">
        <x-input.date wire:model.lazy="state.rg_issue_date" id="rg_issue_date"
                      placeholder="DD/MM/AAAA" />
    </x-input.group>

    <x-input.group for="occupation" label="Profissão" :error="$errors->first('occupation')">
        <x-input.text wire:model.lazy="state.occupation" id="occupation" placeholder="Digite a profissão do proponente" />
    </x-input.group>

    <x-input.group for="email" label="E-mail" :error="$errors->first('email')">
        <x-input.text wire:model.lazy="state.email" id="email" placeholder="Digite o endereço de e-mail do proponente" />
    </x-input.group>

    <x-input.group for="monthly_income" label="Renda mensal">
        <x-input.decimal wire:model.lazy="state.monthly_income" id="monthly_income"
                         placeholder="0,00" />
    </x-input.group>

    <x-input.group for="father_name" label="Nome do pai" :error="$errors->first('father_name')">
        <x-input.text wire:model.lazy="state.father_name" id="father_name" placeholder="Digite o nome do pai do proponente" />
    </x-input.group>

    <x-input.group for="mother_name" label="Nome da mãe" :error="$errors->first('mother_name')">
        <x-input.text wire:model.lazy="state.mother_name" id="mother_name" placeholder="Digite o nome da mãe do proponente" />
    </x-input.group>
</div>