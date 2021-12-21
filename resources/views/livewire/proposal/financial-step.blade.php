<div>
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
                    $free = $proposalData['type'] === \App\Enums\ProposalType::FREE;
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
                        @class(['px-4', 'py-2', 'bg-primary', 'text-white',
                        'bg-opacity-80' => $installments])
                        @if($installments) disabled @endif
                        wire:click="$set('proposalData.type', 2)"
                >
                    Parcelado
                </button>
                <button type="button"
                        @class(['px-4', 'py-2', 'rounded-r', 'bg-primary', 'text-white',
                        'bg-opacity-80' => $free])
                        @if($free) disabled @endif
                        wire:click="$set('proposalData.type', 3)"
                >
                    Outros
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

                            <x-input-row class="my-4 items-center">
                                <div class="my-4">
                                    <x-input.group :error="$errors->first('installmentDate')" inline for="installment-date" label="Data de pagamento da primeira parcela">
                                        <x-input.date wire:model.lazy="installmentDate" id="installment-date"
                                                      placeholder="DD/MM/AAAA" />
                                    </x-input.group>
                                </div>
                            </x-input-row>
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

        <div>
            @if($free)
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

                <x-input-row class="mb-4">
                    <div class="w-full">
                        <x-textarea
                                label="Condições da proposta"
                                name="free_conditions"
                                class="mt-1 w-full"
                                wire:model.lazy="proposalData.free_conditions"
                                error="{{ $errors->first('free_conditions') }}"
                        >
                        </x-textarea>
                    </div>
                </x-input-row>
            @endif
        </div>

        <div class="my-4">
            <x-input.group :error="$errors->first('paymentDate')" inline for="payment-date" label="Data de pagamento da entrada/sinal">
                <x-input.date wire:model.lazy="paymentDate" id="payment-date"
                              placeholder="DD/MM/AAAA" />
            </x-input.group>
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
