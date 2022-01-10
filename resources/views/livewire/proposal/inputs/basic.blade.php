<div>
    <div class="flex justify-center mb-2 space-x-2 items-end">
        <x-input.group :inline="true" for="cpf" label="CPF" :error="$errors->first('state.cpf')">
            <x-input.text wire:model.lazy="state.cpf" id="cpf" x-ref="cpf"
                          placeholder="Número de CPF" />
        </x-input.group>
        <x-button wire:click="findPersonByCPF" type="button">Preencher</x-button>
    </div>

    <x-input.group for="first_name" label="Primeiro nome" :error="$errors->first('state.first_name')">
        <x-input.text wire:model.lazy="state.first_name" id="first_name"
                      placeholder="Digite o primeiro nome" />
    </x-input.group>

    <x-input.group for="last_name" label="Sobrenome" :error="$errors->first('state.last_name')">
        <x-input.text wire:model.lazy="state.last_name" id="last_name"
                      placeholder="Digite o sobrenome" />
    </x-input.group>

    <x-input.group for="phone" label="Telefone" :error="$errors->first('state.phone')">
        <x-input.text wire:model.lazy="state.phone" id="phone"
                      placeholder="Digite o telefone" />
    </x-input.group>

    <x-input.group for="civil_status" label="Estado civil" :error="$errors->first('state.detail.civil_status')">
        <x-input.select wire:model="state.detail.civil_status" id="civil_status">
            <option value="" disabled>Selecione...</option>

            @foreach (\App\Enums\CivilStatus::getInstances() as $status)
                <option value="{{ $status->value }}">{{ $status->description }}</option>
            @endforeach
        </x-input.select>
    </x-input.group>

    <x-input.group for="birth_date" label="Data de nascimento" :error="$errors->first('state.detail.birth_date')">
        <x-input.date wire:model.lazy="state.detail.birth_date" id="state.detail.birth_date"
                      placeholder="DD/MM/AAAA" />
    </x-input.group>

    <x-input.group for="birth_location" label="Naturalidade" :error="$errors->first('state.detail.birth_location')">
        <x-input.text wire:model.lazy="state.detail.birth_location" id="birth_location"
                      placeholder="Cidade - UF" />
    </x-input.group>

    <x-input.group for="nationality" label="Nacionalidade" :error="$errors->first('state.detail.nationality')">
        <x-input.text wire:model.lazy="state.detail.nationality" id="nationality"
                      placeholder="Digite a nacionalidade" />
    </x-input.group>

    <x-input.group for="rg" label="RG" :error="$errors->first('state.detail.rg')">
        <x-input.text wire:model.lazy="state.detail.rg" id="rg" placeholder="Digite o RG" />
    </x-input.group>

    <x-input.group for="rg_issuer" label="Órgão emissor" :error="$errors->first('state.detail.rg_issuer')">
        <x-input.text wire:model.lazy="state.detail.rg_issuer" id="rg_issuer" placeholder="Digite o órgão emissor" />
    </x-input.group>

    <x-input.group for="rg_issue_date" label="Data de emissão RG" :error="$errors->first('state.detail.rg_issue_date')">
        <x-input.date wire:model.lazy="state.detail.rg_issue_date" id="state.detail.rg_issue_date"
                      placeholder="DD/MM/AAAA" />
    </x-input.group>

    <x-input.group for="occupation" label="Profissão" :error="$errors->first('state.detail.occupation')">
        <x-input.text wire:model.lazy="state.detail.occupation" id="occupation" placeholder="Digite a profissão" />
    </x-input.group>

    <x-input.group for="email" label="E-mail" :error="$errors->first('state.detail.email')">
        <x-input.text wire:model.lazy="state.detail.email" id="email" placeholder="Digite o endereço de e-mail" />
    </x-input.group>

    <x-input.group for="monthly_income" label="Renda mensal" :error="$errors->first('state.detail.monthly_income')">
        <x-input.decimal wire:model.lazy="state.detail.monthly_income" id="monthly_income"
                         placeholder="0,00" />
    </x-input.group>

    <x-input.group for="father_name" label="Nome do pai" :error="$errors->first('state.detail.father_name')">
        <x-input.text wire:model.lazy="state.detail.father_name" id="father_name" placeholder="Digite o nome do pai" />
    </x-input.group>

    <x-input.group for="mother_name" label="Nome da mãe" :error="$errors->first('state.detail.mother_name')">
        <x-input.text wire:model.lazy="state.detail.mother_name" id="mother_name" placeholder="Digite o nome da mãe" />
    </x-input.group>

    @if($state['detail']['civil_status'] === \App\Enums\CivilStatus::MARRIED)
        <x-input.group for="marriage_date" label="Data de casamento"
                       :error="$errors->first('state.detail.marriage_date')">
            <x-input.date wire:model.lazy="state.detail.marriage_date" id="marriage_date"
                          placeholder="DD/MM/AAAA" />
        </x-input.group>

        <x-input.group for="marriage_regime" label="Regime de casamento"
                       :error="$errors->first('state.detail.marriage_regime')">
            <x-input.text wire:model.lazy="state.detail.marriage_regime" id="marriage_regime"
                          placeholder="Digite o regime de casamento" />
        </x-input.group>
    @endif
</div>