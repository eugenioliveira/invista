@php
    /** @var \Illuminate\Database\Eloquent\Collection $plans */
    /** @var \App\Models\PaymentPlan $plan */
@endphp

<x-app-layout title="Criando um novo plano de pagamento">

    <x-slot name="header">
        <div class="flex items-center justify-between">
            <x-header-text>Criando um novo plano de pagamento</x-header-text>
        </div>
    </x-slot>

    <x-section>
        <livewire:create-payment-plan-form />
    </x-section>

</x-app-layout>
