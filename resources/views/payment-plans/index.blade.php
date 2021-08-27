@php
    /** @var \Illuminate\Database\Eloquent\Collection $plans */
    /** @var \App\Models\PaymentPlan $plan */
@endphp

<x-app-layout title="Planos de pagamento">

    <x-slot name="header">
        <div class="flex items-center justify-between">
            <x-header-text>Planos de pagamento parcelados</x-header-text>
            @if(\Auth::user()->isAdmin())
                <div>
                    <x-button-link href="{{ route('payment-plans.create') }}">Criar novo</x-button-link>
                </div>
            @endif
        </div>
    </x-slot>

    <x-section>
        {{-- Success message --}}
        @if(session('successMessage'))
            <x-alert type="success" message="{{ session('successMessage') }}"/>
        @endif

        @if ($plans->isNotEmpty())
            {{-- Lots table --}}
            <x-card class="my-4 p-4">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead>
                    <tr>
                        <th class="px-6 py-3 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">
                            #
                        </th>
                        <th class="px-6 py-3 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">
                            Nome
                        </th>
                        <th class="px-6 py-3 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">
                            Descrição
                        </th>
                        <th class="px-6 py-3 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">
                            Entrada mìnima (%)
                        </th>
                        <th class="px-6 py-3 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">
                            Prazo máximo
                        </th>
                        <th class="px-6 py-3 bg-gray-50"></th>
                    </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                    @foreach($plans as $plan)
                        <tr>
                            {{-- ID --}}
                            <td class="px-6 py-4 whitespace-no-wrap text-gray-300">
                                {{ $plan->id }}
                            </td>
                            {{-- Name --}}
                            <td class="px-6 py-4 whitespace-no-wrap">
                                {{ $plan->name }}
                            </td>
                            {{-- Description --}}
                            <td class="px-6 py-4 whitespace-no-wrap">
                                {{ $plan->description }}
                            </td>
                            {{-- Min Down Payment --}}
                            <td class="px-6 py-4 whitespace-no-wrap">
                                {{ $plan->min_down_payment }}
                            </td>
                            {{-- Max Installments --}}
                            <td class="px-6 py-4 whitespace-no-wrap">
                                {{ $plan->installment_indexes->pluck('installments')->max() }} parcelas
                            </td>
                            {{-- Actions --}}
                            <td class="px-6 py-4 flex space-x-1">
                                {{-- Edit action --}}
                                <x-button-link href="{{ route('payment-plans.edit', $plan->id) }}" format="icon" title="Editar">
                                    <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20"
                                         xmlns="http://www.w3.org/2000/svg">
                                        <path
                                                d="M13.586 3.586a2 2 0 112.828 2.828l-.793.793-2.828-2.828.793-.793zM11.379 5.793L3 14.172V17h2.828l8.38-8.379-2.83-2.828z"></path>
                                    </svg>
                                </x-button-link>
                                {{-- Delete action --}}
                            </td>
                        </tr>
                    @endforeach

                    {{-- More rows... --}}
                    </tbody>
                </table>
            </x-card>
        @else
            <x-alert type="warning" message="Nenhum plano de pagamento parcelado cadastrado."
                     :autoclose="false"></x-alert>
        @endif
    </x-section>

</x-app-layout>
