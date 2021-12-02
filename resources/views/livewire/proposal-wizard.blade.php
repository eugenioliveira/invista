<div class="rounded-md shadow overflow-hidden max-w-3xl mx-auto">
    <!-- Header -->
    <div class="bg-primary border-b-2 border-gray-500 p-4">
        <h1 class="text-white font-bold">{{ $stepsConfig[$currentStep]['heading'] }}</h1>
        <h4 class="text-white text-sm opacity-90">{{ $stepsConfig[$currentStep]['subheading'] }}</h4>
    </div>
    <!-- Body -->
    <div class="bg-white">
        <div @class(['hidden' => $currentStep !== \App\Enums\ProposalWizardSteps::CLIENT_STEP])>
            <!-- Primeiro passo: dados do cliente -->
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
                            <x-moneyinput
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

        <div @class(['hidden' => $currentStep !== \App\Enums\ProposalWizardSteps::FINANCIAL_STEP])>
            <div class="p-4">
                <p>
                    <strong>Valor do lote:</strong> {{ $lot->formatted_price }}
                </p>
                <div class="text-center">
                    <h1>Selecione a forma de pagamento</h1>
                    <div class="flex justify-center">
                        @php
                            $inCash = $proposalData['type'] === \App\Enums\ProposalType::IN_CASH;
                            $installments = $proposalData['type'] === \App\Enums\ProposalType::INSTALLMENTS;
                        @endphp
                        <button type="button"
                                @class(['px-4', 'py-2', 'rounded-l', 'bg-primary', 'text-white',
                                'bg-opacity-80' => $inCash])
                                @if($inCash) disabled @endif
                                wire:click="$set('proposalData.type', 1)"
                        >
                            À vista
                        </button>
                        <button type="button"
                                @class(['px-4', 'py-2', 'rounded-r', 'bg-primary', 'text-white',
                                'bg-opacity-80' => $installments])
                                @if($installments) disabled @endif
                                wire:click="$set('proposalData.type', 2)"
                        >
                            Parcelado
                        </button>
                    </div>
                </div>

                <div>
                    @if($inCash)
                        <div>
                            <x-input-row class="my-4 items-center">
                                <h2 class="text-lg uppercase tracking-widest">Proposta de pagamento à vista</h2>
                                <div class="flex-1 h-0.5 bg-gray-200"></div>
                            </x-input-row>

                            <x-input-row class="mb-4">
                                {{-- Valor negociado do lote --}}
                                <div class="w-full">
                                    <x-moneyinput
                                            label="Valor negociado (em R$)"
                                            name="negotiated"
                                            class="mt-1 w-full"
                                            wire:model.lazy="negotiated"
                                            error="{{ $errors->first('negotiated') }}"
                                    />
                                </div>
                            </x-input-row>
                        </div>
                    @endif
                </div>

                <div>
                    @if($installments)
                        <div>
                            @if(count($lot->allotment->plans) > 0)
                                <div>
                                    <x-input-row class="my-4 items-center">
                                        <h2 class="text-lg uppercase tracking-widest">Proposta de pagamento
                                            parcelado</h2>
                                        <div class="flex-1 h-0.5 bg-gray-200"></div>
                                    </x-input-row>

                                    <x-input-row class="mb-4">
                                        <x-select
                                                label="Selecione um plano de pagamento"
                                                name="plan"
                                                class="mt-1 w-full"
                                                wire:model.lazy="selectedPaymentPlan"
                                                error="{{ $errors->first('selectedPaymentPlan') }}"
                                        >
                                            <option>Selecione...</option>
                                            @foreach($lot->allotment->plans as $plan)
                                                <option value="{{ $plan->id }}">{{ $plan->description }}</option>
                                            @endforeach
                                        </x-select>
                                    </x-input-row>

                                    <div>
                                        @if($paymentPlan)
                                            <x-input-row class="mb-4">
                                                <div class="w-full">
                                                    <x-moneyinput
                                                            label="Valor de entrada (em R$)"
                                                            name="down_payment"
                                                            class="mt-1 w-full"
                                                            wire:model.lazy="downPayment"
                                                            error="{{ $errors->first('downPayment') }}"
                                                    />
                                                </div>
                                            </x-input-row>
                                        @endif
                                    </div>

                                    <div>
                                        @if($simulatedInstallments->isNotEmpty())
                                            <x-select
                                                    label="Selecione um parcelamento"
                                                    name="installment_value"
                                                    class="mt-1 w-full"
                                                    wire:model.lazy="selectedInstallmentValue"
                                                    error="{{ $errors->first('selectedInstallmentValue') }}"
                                            >
                                                <option>Selecione...</option>
                                                @foreach($simulatedInstallments as $key => $installment)
                                                    <option value="{{ $key }}">{{ $installment['installments'] }}
                                                        parcelas
                                                        de {{ app('currency')->format($installment['value']) }}</option>
                                                @endforeach
                                            </x-select>
                                        @endif
                                    </div>
                                </div>
                            @else
                                <div class="my-4">
                                    <x-alert type="danger" :autoclose="false">
                                        Não é possível fazer uma proposta de pagamento parcelada pois não há plano de
                                        pagamento
                                        parcelado associado ao loteamento. Favor, entre em contato com o administrador.
                                    </x-alert>
                                </div>
                            @endif
                        </div>
                    @endif
                </div>

                <div class="my-4">
                    <x-textarea
                            label="Observações a cerca da proposta"
                            name="comments"
                            class="mt-1 w-full"
                            wire:model.lazy="proposalData.comments"
                            error="{{ $errors->first('comments') }}"
                    >
                    </x-textarea>
                </div>

            </div>
        </div>

        <div @class(['hidden' => $currentStep !== \App\Enums\ProposalWizardSteps::DOCUMENT_STEP])>
            <div class="p-4 space-y-3">
                <div>
                    @if($proposal->documents->isNotEmpty())
                        <div class="p-4 border rounded">
                            <h1 class='text-lg font-medium'>Documentos cadastrados</h1>
                            <ul class="list-disc px-4">
                                @foreach($proposal->documents as $document)
                                    <li>
                                        <a
                                                target="_blank"
                                                class="text-blue-500 hover:underline"
                                                href="{{ \Storage::disk('documents')->url($document->filename) }}">
                                            {{ $document->filename }}
                                        </a>
                                        <span> - </span>
                                        <x-button.link wire:click='deleteDocument({{ $document->id }})'>
                                            Remover
                                        </x-button.link>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                </div>
                <div wire:ignore>
                    <div x-data="{
                        init() {
                            FilePond.setOptions({
                                allowMultiple: true,
                                server: {
                                    process: (fieldName, file, metadata, load, error, progress, abort, transfer, options) => {
                                        @this.upload('documents', file, load, error, progress);
                                    },
                                    revert: (filename, load) => {
                                        @this.removeUpload('documents', filename, load);
                                    }
                                }
                            });
                            FilePond.create($refs.documentUploadInput, {
                                acceptedFileTypes: ['image/png', 'image/jpeg', 'application/pdf'],
                            });
                        }
                    }">
                        <input x-ref="documentUploadInput" type="file" multiple>
                    </div>

                </div>
                @error('documents')
                <x-alert type="danger" :autoclose="false">{{ $message }}</x-alert>
                @enderror
                @error('documents.*')
                <x-alert type="danger" :autoclose="false">{{ $message }}</x-alert>
                @enderror
            </div>
        </div>
    </div>
    <!-- Botões -->
    <div class="p-4 bg-gray-100 border-t-2 border-gray-500 flex justify-around">
        <div>
            @if($currentStep > \App\Enums\ProposalWizardSteps::CLIENT_STEP && $currentStep <= \App\Enums\ProposalWizardSteps::DOCUMENT_STEP)
                <button type="button"
                        class="bg-primary px-4 py-2 rounded-md text-white font-medium flex items-center"
                        wire:click="decreaseStep">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24"
                         stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="M11 19l-7-7 7-7m8 14l-7-7 7-7" />
                    </svg>
                    <span>Voltar</span>
                </button>
            @endif
        </div>
        <div>
            @if($currentStep === \App\Enums\ProposalWizardSteps::DOCUMENT_STEP)
                <button type="button"
                        class="bg-primary px-4 py-2 rounded-md text-white font-medium flex items-center"
                        wire:click="submitProposal">
                    Enviar
                </button>
            @endif
        </div>
        <div>
            @if($currentStep < \App\Enums\ProposalWizardSteps::DOCUMENT_STEP)
                <button type="button"
                        class="bg-primary px-4 py-2 rounded-md text-white font-medium flex items-center"
                        wire:click="nextStep">
                    <span>Avançar</span>
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24"
                         stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="M13 5l7 7-7 7M5 5l7 7-7 7" />
                    </svg>
                </button>
            @endif
        </div>
    </div>

    <x-loading></x-loading>
</div>