@php
    /** @var \App\Models\Allotment $allotment */
    /** @var \Illuminate\Support\Collection $availablePlans */
    /** @var \Illuminate\Support\Collection $allotmentPlans */
@endphp
<x-card class="p-4 max-w-3xl mx-auto">

    @if($successMessage)
        <x-alert type="success" message="{{ $successMessage }}"/>
    @endif

        <div x-cloak x-data="{
            allotmentPlans: {{ $allotmentPlans->toJson() }},
            availablePlans: {{ $availablePlans->toJson() }},
            selectedPlans: @entangle('selectedPlans'),
            selectedAllotmentPlan: '',
            selectedAvailablePlan: '',
            init() {
                this.updateSelectedPlans();
            },
            toggleSelectedAllotmentPlan(planId) {
                this.selectedAllotmentPlan = (this.selectedAllotmentPlan !== planId) ? planId : '';
            },
            toggleSelectedAvailablePlan(planId) {
                this.selectedAvailablePlan = (this.selectedAvailablePlan !== planId) ? planId : '';
            },
            addAllotmentPlan() {
                let planToAdd = _.find(this.availablePlans, { id: this.selectedAvailablePlan });
                if (planToAdd) {
                    this.allotmentPlans.push(planToAdd);
                    _.remove(this.availablePlans, { id: this.selectedAvailablePlan });
                    this.updateSelectedPlans();
                }
            },
            addAvailablePlan() {
                let planToAdd = _.find(this.allotmentPlans, { id: this.selectedAllotmentPlan });
                if (planToAdd) {
                    this.availablePlans.push(planToAdd);
                    _.remove(this.allotmentPlans, { id: this.selectedAllotmentPlan });
                    this.updateSelectedPlans();
                }
            },
            updateSelectedPlans() {
                this.selectedPlans = [];
                this.allotmentPlans.map((plan) => this.selectedPlans.push(plan.id));
            }
        }">
            <form>

                <div class="flex space-x-3">
                    {{-- Planos de pagamento selecionados --}}
                    <div class="w-2/5 rounded-lg border border-gray-300 p-2">
                        <h2 class="font-bold">Planos de pagamento selecionados</h2>
                        <hr class="my-2">
                        <template x-for="plan in allotmentPlans" :key="plan.id">
                            <div>
                                <div
                                        class="flex items-center space-x-2 p-2 cursor-pointer"
                                        :class="selectedAllotmentPlan === plan.id && 'bg-blue-100'"
                                        @click="toggleSelectedAllotmentPlan(plan.id)">
                                    <div>
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none"
                                             viewBox="0 0 24 24"
                                             stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                  d="M17 9V7a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2m2 4h10a2 2 0 002-2v-6a2 2 0 00-2-2H9a2 2 0 00-2 2v6a2 2 0 002 2zm7-5a2 2 0 11-4 0 2 2 0 014 0z"/>
                                        </svg>
                                    </div>
                                    <div>
                                        <h2 class="text-sm" x-text="plan.name"></h2>
                                        <div class="w-52 text-xs text-gray-500 overflow-hidden whitespace-nowrap overflow-ellipsis"
                                             x-text="plan.description"></div>
                                    </div>
                                </div>
                            </div>
                        </template>

                    </div>

                    {{-- Botões --}}
                    <div class="w-1/5 flex flex-col justify-center">
                        <div class="p-2 flex flex-col space-y-2 rounded-lg border border-gray-300">
                            <button type="button" @click="addAvailablePlan()"
                                    class="border border-gray-400 rounded-lg py-1 hover:bg-gray-300">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 inline-block" fill="none"
                                     viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                          d="M9 5l7 7-7 7"/>
                                </svg>
                            </button>
                            <button type="button" @click="addAllotmentPlan()"
                                    class="border border-gray-400 rounded-lg py-1 hover:bg-gray-300">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 inline-block" fill="none"
                                     viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                          d="M15 19l-7-7 7-7"/>
                                </svg>
                            </button>
                        </div>
                    </div>

                    {{-- Planos de pagamento disponíveis --}}
                    <div class="w-2/5 rounded-lg border border-gray-300 p-2">
                        <h2 class="font-bold">Planos de pagamento disponíveis</h2>
                        <hr class="my-2">
                        <template x-for="plan in availablePlans" :key="plan.id">
                            <div>
                                <div class="flex items-center space-x-2 p-2 cursor-pointer"
                                     :class="selectedAvailablePlan === plan.id && 'bg-blue-100'"
                                     @click="toggleSelectedAvailablePlan(plan.id)">
                                    <div>
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none"
                                             viewBox="0 0 24 24"
                                             stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                  d="M17 9V7a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2m2 4h10a2 2 0 002-2v-6a2 2 0 00-2-2H9a2 2 0 00-2 2v6a2 2 0 002 2zm7-5a2 2 0 11-4 0 2 2 0 014 0z"/>
                                        </svg>
                                    </div>
                                    <div>
                                        <h2 class="text-sm" x-text="plan.name"></h2>
                                        <div class="w-52 text-xs text-gray-500 overflow-hidden whitespace-nowrap overflow-ellipsis"
                                             x-text="plan.description"></div>
                                    </div>
                                </div>
                            </div>
                        </template>
                    </div>
                </div>

                <x-input-row class="mt-6">
                    <x-button type="button" wire:click="updatePlans">Salvar e Voltar</x-button>
                    <x-button type="button" wire:click="updatePlans(false)">Salvar e Continuar</x-button>
                    <x-button-link type="danger" href="{{ route('allotments.index') }}">Cancelar</x-button-link>
                </x-input-row>
            </form>
        </div>
</x-card>
