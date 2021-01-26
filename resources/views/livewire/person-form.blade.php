@php
    /** @var \App\Models\Person $person */
    /** @var \App\Models\PersonDetail $detail */
@endphp

<x-card class="p-4 max-w-3xl mx-auto">

    @if($successMessage)
        <x-alert type="success" message="{{ $successMessage }}"/>
    @endif

    <form>
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
                        wire:model="address.postal_code"
                        wire:blur="getAddressByPostalCode"
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

        <x-input-row class="mt-6 mb-6 md:mt-0 items-center">
            <h2 class="text-lg uppercase tracking-widest">Cônjuge</h2>
            <div class="flex-1 h-0.5 bg-gray-200"></div>
        </x-input-row>

        <div class="md:mb-4">
            <div class="md:flex bg-orange-100 border shadow-lg rounded-md border-orange-400">
                <div class="bg-orange-400 text-white md:flex md:justify-center md:items-center md:w-16">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path>
                    </svg>
                </div>
                @if($detail->partner)
                    <div class="md:w-1/3 px-4 py-2 md:flex md:items-center md:border-r md:border-dashed md:border-orange-400">
                        <div>
                            <h2 class="text-lg text-orange-600">{{ $detail->partner->full_name }}</h2>
                            <p class="text-sm">CPF: {{ $detail->partner->cpf }}</p>
                        </div>
                    </div>
                    <div class="md:w-1/3 p-2 md:flex md:items-center md:border-r md:border-dashed md:border-orange-400">
                        <p class="text-sm">
                            @if($detail->partner->detail)
                                <span class="text-green-500 font-medium">As informações do cônjuge estão completas.</span>
                            @else
                                <span class="text-red-500 font-medium">As informações do cônjuge estão incompletas!</span>
                                <br>
                                <span class="text-xs">Faltam informações como naturalidade, nacionalidade, renda mensal...</span>
                            @endif
                        </p>
                    </div>
                    <div class="p-2 flex flex-col space-y-2">
                        <x-button type="button">Remover cônjuge</x-button>
                        <x-button type="button">Editar cônjuge</x-button>
                    </div>
                @else
                    <div class="px-4 py-2 flex items-center border-r border-dashed border-orange-400">
                        <div>
                            <h2 class="text-lg text-orange-600">Nenhum cônjuge cadastrado.</h2>
                            <p class="text-sm">O cadastro de cônjuge é obrigatório se o estado civil é casado(a).</p>
                        </div>
                    </div>
                    <div class="px-4 py-2 border-r border-dashed border-orange-400 flex flex-col">
                        <div>
                            <label for="partner_cpf" class="text-orange-600 text-sm font-medium">Digite o CPF do cônjuge</label>
                            <div class="flex items-center space-x-2">
                                <input
                                        id="partner_cpf"
                                        name="partner_cpf"
                                        type="text"
                                        wire:model.lazy="state.partner_cpf"
                                        class="mt-1 px-2 py-1 border border-orange-400 rounded-md appearance-none focus:outline-none focus:ring focus:ring-orange-400"
                                >
                                <button
                                        type="button"
                                        class="bg-orange-400 text-white hover:bg-orange-600 transition duration-150 px-4 py-2 rounded-md"
                                        wire:click="addPartner"
                                >
                                    OK
                                </button>
                            </div>
                            @error('state.partner_cpf')
                            <p class="mt-1 text-sm font-bold text-red-500">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="flex items-center space-x-2 my-2">
                            <div class="border-b border-orange-400 flex-1"></div>
                            <div>ou</div>
                            <div class="border-b border-orange-400 flex-1"></div>
                        </div>
                        <x-button type="button">
                            Cadastrar cônjuge
                        </x-button>
                    </div>
                @endif
            </div>
        </div>

        <x-input-row class="mt-6 flex flex-col space-y-2 md:space-y-0 md:flex-row">
            <x-button type="button" wire:click="savePerson">Salvar e Voltar</x-button>
            <x-button type="button" wire:click="savePerson(false)">Salvar e Continuar</x-button>
            <x-button-link type="danger" href="{{ route('people.index') }}">Cancelar</x-button-link>
        </x-input-row>
    </form>

</x-card>