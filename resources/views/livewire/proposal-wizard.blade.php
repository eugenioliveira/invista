<div>
    <div class="rounded-md shadow overflow-hidden max-w-3xl mx-auto">
        <!-- Header -->
        <div class="bg-primary border-b-2 border-gray-500 p-4">
            <h1 class="text-white font-bold">{{ $stepsConfig[$currentStep]['heading'] }}</h1>
            <h4 class="text-white text-sm opacity-90">{{ $stepsConfig[$currentStep]['subheading'] }}</h4>
        </div>
        <!-- Body -->
        <div class="bg-white">
            @if($currentStep === \App\Enums\ProposalWizardSteps::CLIENT_STEP)
                <div> <!-- Primeiro passo: dados do cliente -->
                    @php
                        $reserveable = $lot->activeReservation->reserveable
                    @endphp
                    <dl>
                        <div class="bg-gray-50 px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                            <dt class="text-sm font-medium text-gray-500">
                                Nome completo
                            </dt>
                            <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
                                {{ $reserveable->full_name }}
                            </dd>
                        </div>
                        <div class="bg-white px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                            <dt class="text-sm font-medium text-gray-500">
                                Número de CPF
                            </dt>
                            <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
                                {{ $reserveable->cpf }}
                            </dd>
                        </div>
                        <div class="bg-gray-50 px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                            <dt class="text-sm font-medium text-gray-500">
                                Telefone
                            </dt>
                            <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
                                {{ $reserveable->phone }}
                            </dd>
                        </div>
                    </dl>

                    <hr>

                    <div class="px-4 py-5">
                        <h2 class="font-medium mb-6">Dados complementares</h2>
                        <form>
                            <x-input-row class="space-y-3 md:space-y-0 md:mb-4">
                                {{-- Estado Civil --}}
                                <div class="md:w-1/4">
                                    <x-select
                                            label="Estado civil"
                                            name="civil_status"
                                            class="mt-1 w-full"
                                            wire:model.lazy="clientData.civil_status"
                                            error="{{ $errors->first('civil_status') }}"
                                    >
                                        @foreach(\App\Enums\CivilStatus::getInstances() as $status)
                                            <option value="{{ $status->value }}">{{ $status->description }}</option>
                                        @endforeach
                                    </x-select>
                                </div>
                                {{-- Data de nascimento --}}
                                <div class="md:w-1/4">
                                    <x-input
                                            label="Data de nascimento"
                                            name="birth_date"
                                            class="mt-1 w-full"
                                            wire:model.lazy="clientData.birth_date"
                                            error="{{ $errors->first('birth_date') }}"
                                    />
                                </div>
                                {{-- Naturalidade --}}
                                <div class="md:w-2/4">
                                    <x-input
                                            label="Naturalidade"
                                            name="birth_location"
                                            class="mt-1 w-full"
                                            wire:model.lazy="clientData.birth_location"
                                            error="{{ $errors->first('birth_location') }}"
                                    />
                                </div>
                            </x-input-row>

                            <x-input-row class="space-y-3 md:space-y-0 md:mb-4">
                                {{-- Nacionalidade --}}
                                <div class="md:w-2/4">
                                    <x-input
                                            label="Nacionalidade"
                                            name="nationality"
                                            class="mt-1 w-full"
                                            wire:model.lazy="clientData.nationality"
                                            error="{{ $errors->first('nationality') }}"
                                    />
                                </div>
                                {{-- RG --}}
                                <div class="md:w-1/4">
                                    <x-input
                                            label="RG"
                                            name="rg"
                                            class="mt-1 w-full"
                                            wire:model.lazy="clientData.rg"
                                            error="{{ $errors->first('rg') }}"
                                    />
                                </div>
                                {{-- RG --}}
                                <div class="md:w-1/4">
                                    <x-input
                                            label="Órgão emissor"
                                            name="rg_issuer"
                                            class="mt-1 w-full"
                                            wire:model.lazy="clientData.rg_issuer"
                                            error="{{ $errors->first('rg_issuer') }}"
                                    />
                                </div>
                            </x-input-row>

                            <x-input-row class="space-y-3 md:space-y-0 md:mb-4">
                                {{-- Profissão --}}
                                <div class="md:w-1/3">
                                    <x-input
                                            label="Profissão"
                                            name="occupation"
                                            class="mt-1 w-full"
                                            wire:model.lazy="clientData.occupation"
                                            error="{{ $errors->first('occupation') }}"
                                    />
                                </div>
                                {{-- Profissão --}}
                                <div class="md:w-1/3">
                                    <x-input
                                            label="E-mail"
                                            name="email"
                                            class="mt-1 w-full"
                                            wire:model.lazy="clientData.email"
                                            error="{{ $errors->first('email') }}"
                                    />
                                </div>
                                {{-- Profissão --}}
                                <div class="md:w-1/3">
                                    <x-input
                                            label="Renda mensal (em R$)"
                                            name="monthly_income"
                                            class="mt-1 w-full"
                                            wire:model.lazy="clientData.monthly_income"
                                            error="{{ $errors->first('monthly_income') }}"
                                    />
                                </div>
                            </x-input-row>

                            <x-input-row class="space-y-3 md:space-y-0 md:mb-4">
                                {{-- Nome do pai --}}
                                <div class="md:w-1/2">
                                    <x-input
                                            label="Nome do pai"
                                            name="father_name"
                                            class="mt-1 w-full"
                                            wire:model.lazy="clientData.father_name"
                                            error="{{ $errors->first('father_name') }}"
                                    />
                                </div>
                                {{-- Nome da mãe --}}
                                <div class="md:w-1/2">
                                    <x-input
                                            label="Nome da mãe"
                                            name="mother_name"
                                            class="mt-1 w-full"
                                            wire:model.lazy="clientData.mother_name"
                                            error="{{ $errors->first('mother_name') }}"
                                    />
                                </div>
                            </x-input-row>
                        </form>
                    </div>
                </div>
            @endif
        </div>
        <!-- Botões -->
        <div class="p-4 bg-gray-100 border-t-2 border-gray-500 flex justify-around">
            @if($currentStep > \App\Enums\ProposalWizardSteps::CLIENT_STEP && $currentStep < \App\Enums\ProposalWizardSteps::DOCUMENT_STEP)
                <button type="button"
                        class="bg-primary px-4 py-2 rounded-md text-white font-medium flex items-center">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24"
                         stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="M11 19l-7-7 7-7m8 14l-7-7 7-7"/>
                    </svg>
                    <span>Voltar</span>
                </button>
            @endif
            @if($currentStep === \App\Enums\ProposalWizardSteps::DOCUMENT_STEP)
                <button type="button"
                        class="bg-primary px-4 py-2 rounded-md text-white font-medium flex items-center">
                    Enviar
                </button>
            @endif
            @if($currentStep < \App\Enums\ProposalWizardSteps::DOCUMENT_STEP)
                <button type="button"
                        class="bg-primary px-4 py-2 rounded-md text-white font-medium flex items-center"
                        wire:click="nextStep">
                    <span>Avançar</span>
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24"
                         stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="M13 5l7 7-7 7M5 5l7 7-7 7"/>
                    </svg>
                </button>
            @endif
        </div>
    </div>
</div>
