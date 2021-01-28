@props(['address' => true])

<div>
    <x-input-row class="mt-6 mb-6 md:mt-0 items-center">
        <h2 class="text-lg uppercase tracking-widest">Informações básicas</h2>
        <div class="flex-1 h-0.5 bg-gray-200"></div>
    </x-input-row>

    <x-input-row class="space-y-3 md:space-y-0 md:mb-4">
        <!-- Primeiro Nome -->
        <div class="md:w-1/2">
            <x-input
                    label="Primeiro nome"
                    name="firstname"
                    class="mt-1 w-full"
                    wire:model.lazy="person.firstname"
                    error="{{ $errors->first('person.firstname') }}"
            />
        </div>
        <!-- Sobrenome -->
        <div class="md:w-1/2">
            <x-input
                    label="Sobrenome"
                    name="lastname"
                    class="mt-1 w-full"
                    wire:model.lazy="person.lastname"
                    error="{{ $errors->first('person.lastname') }}"
            />
        </div>
    </x-input-row>

    <x-input-row class="space-y-3 md:space-y-0 md:mb-4">
        <!-- CPF -->
        <div class="md:w-1/2">
            <x-input
                    label="Número de CPF"
                    name="cpf"
                    class="mt-1 w-full"
                    wire:model.lazy="person.cpf"
                    error="{{ $errors->first('person.cpf') }}"
            />
        </div>
        <!-- Telefone -->
        <div class="md:w-1/2">
            <x-input
                    label="Número de Telefone"
                    name="phone"
                    class="mt-1 w-full"
                    wire:model.lazy="person.phone"
                    error="{{ $errors->first('person.phone') }}"
            />
        </div>
    </x-input-row>

    @if($address)
        <x-input-row class="mt-6 mb-6 md:mt-0 items-center">
            <h2 class="text-lg uppercase tracking-widest">Endereço</h2>
            <div class="flex-1 h-0.5 bg-gray-200"></div>
        </x-input-row>

        <x-input-row class="space-y-3 md:space-y-0 md:mb-4">
            <!-- CEP -->
            <div class="md:w-1/2">
                <x-input
                        label="CEP de residência"
                        name="postal_code"
                        class="mt-1 w-full"
                        wire:model.lazy="address.postal_code"
                        error="{{ $errors->first('address.postal_code') }}"
                />
            </div>
            <!-- Logradouro -->
            <div class="md:w-1/2">
                <x-input
                        label="Logradouro"
                        name="street"
                        class="mt-1 w-full"
                        wire:model.lazy="address.street"
                        wire:loading.delay.attr="disabled"
                        wire:target="getAddressByPostalCode"
                        error="{{ $errors->first('address.street') }}"
                />
            </div>
        </x-input-row>

        <x-input-row class="space-y-3 md:space-y-0 md:mb-4">
            <!-- Número -->
            <div class="md:w-1/5">
                <x-input
                        label="Número"
                        name="number"
                        class="mt-1 w-full"
                        wire:model.lazy="address.number"
                        wire:loading.delay.attr="disabled"
                        wire:target="getAddressByPostalCode"
                        error="{{ $errors->first('address.number') }}"
                />
            </div>
            <!-- Complemento -->
            <div class="md:w-2/5">
                <x-input
                        label="Complemento"
                        name="apt_room"
                        class="mt-1 w-full"
                        wire:model.lazy="address.apt_room"
                        wire:loading.delay.attr="disabled"
                        wire:target="getAddressByPostalCode"
                        error="{{ $errors->first('address.apt_room') }}"
                />
            </div>
            <!-- Bairro -->
            <div class="md:w-2/5">
                <x-input
                        label="Bairro"
                        name="neighbourhood"
                        class="mt-1 w-full"
                        wire:model.lazy="address.neighbourhood"
                        wire:loading.delay.attr="disabled"
                        wire:target="getAddressByPostalCode"
                        error="{{ $errors->first('address.neighbourhood') }}"
                />
            </div>
        </x-input-row>

        <x-input-row class="space-y-3 md:space-y-0 md:mb-4">
            <!-- Cidade -->
            <div class="md:w-1/2">
                <x-input
                        label="Cidade"
                        name="city"
                        class="mt-1 w-full"
                        wire:model.lazy="address.city"
                        wire:loading.delay.attr="disabled"
                        wire:target="getAddressByPostalCode"
                        error="{{ $errors->first('address.city') }}"
                />
            </div>
            <!-- Estado -->
            <div class="md:w-1/2">
                <x-input
                        label="Estado"
                        name="state"
                        class="mt-1 w-full"
                        wire:model.lazy="address.state"
                        wire:loading.delay.attr="disabled"
                        wire:target="getAddressByPostalCode"
                        error="{{ $errors->first('address.state') }}"
                />
            </div>
        </x-input-row>
    @endif

    <x-input-row class="mt-6 mb-6 md:mt-0 items-center">
        <h2 class="text-lg uppercase tracking-widest">Informações complementares</h2>
        <div class="flex-1 h-0.5 bg-gray-200"></div>
    </x-input-row>

    <x-input-row class="space-y-3 md:space-y-0 md:mb-4">
        <!-- Cidade -->
        <div class="md:w-1/4">
            <x-select
                    label="Estado civil"
                    name="civil_status"
                    class="mt-1 w-full"
                    wire:model.lazy="detail.civil_status"
                    error="{{ $errors->first('detail.civil_status') }}"
            >
                <option>Selecione...</option>
                @foreach(\App\Enums\CivilStatus::getInstances() as $status)
                    <option value="{{ $status->value }}">{{ $status->description }}</option>
                @endforeach
            </x-select>
        </div>
        <!-- Data de nascimento -->
        <div class="md:w-1/4">
            <x-input
                    label="Data de nascimento"
                    name="birth_date"
                    class="mt-1 w-full"
                    wire:model.lazy="state.birth"
                    error="{{ $errors->first('state.birth') }}"
            />
        </div>
        <!-- Naturalidade -->
        <div class="md:w-2/4">
            <x-input
                    label="Naturalidade"
                    name="birth_location"
                    class="mt-1 w-full"
                    wire:model.lazy="detail.birth_location"
                    error="{{ $errors->first('detail.birth_location') }}"
            />
        </div>
    </x-input-row>

    <x-input-row class="space-y-3 md:space-y-0 md:mb-4">
        <!-- Nacionalidade -->
        <div class="md:w-2/4">
            <x-input
                    label="Nacionalidade"
                    name="nationality"
                    class="mt-1 w-full"
                    wire:model.lazy="detail.nationality"
                    error="{{ $errors->first('detail.nationality') }}"
            />
        </div>
        <!-- RG -->
        <div class="md:w-1/4">
            <x-input
                    label="RG"
                    name="rg"
                    class="mt-1 w-full"
                    wire:model.lazy="detail.rg"
                    error="{{ $errors->first('detail.rg') }}"
            />
        </div>
        <!-- RG -->
        <div class="md:w-1/4">
            <x-input
                    label="Órgão emissor"
                    name="rg_issuer"
                    class="mt-1 w-full"
                    wire:model.lazy="detail.rg_issuer"
                    error="{{ $errors->first('detail.rg_issuer') }}"
            />
        </div>
    </x-input-row>

    <x-input-row class="space-y-3 md:space-y-0 md:mb-4">
        <!-- Profissão -->
        <div class="md:w-1/3">
            <x-input
                    label="Profissão"
                    name="occupation"
                    class="mt-1 w-full"
                    wire:model.lazy="detail.occupation"
                    error="{{ $errors->first('detail.occupation') }}"
            />
        </div>
        <!-- Profissão -->
        <div class="md:w-1/3">
            <x-input
                    label="E-mail"
                    name="email"
                    class="mt-1 w-full"
                    wire:model.lazy="detail.email"
                    error="{{ $errors->first('detail.email') }}"
            />
        </div>
        <!-- Profissão -->
        <div class="md:w-1/3">
            <x-input
                    label="Renda mensal"
                    name="monthly_income"
                    class="mt-1 w-full"
                    wire:model.lazy="detail.monthly_income"
                    error="{{ $errors->first('detail.monthly_income') }}"
            />
        </div>
    </x-input-row>

    <x-input-row class="space-y-3 md:space-y-0 md:mb-4">
        <!-- Nome do pai -->
        <div class="md:w-1/2">
            <x-input
                    label="Nome do pai"
                    name="father_name"
                    class="mt-1 w-full"
                    wire:model.lazy="detail.father_name"
                    error="{{ $errors->first('detail.father_name') }}"
            />
        </div>
        <!-- Nome da mãe -->
        <div class="md:w-1/2">
            <x-input
                    label="Nome da mãe"
                    name="mother_name"
                    class="mt-1 w-full"
                    wire:model.lazy="detail.mother_name"
                    error="{{ $errors->first('detail.mother_name') }}"
            />
        </div>
    </x-input-row>
</div>