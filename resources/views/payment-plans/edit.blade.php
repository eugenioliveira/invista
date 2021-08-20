@php
    /** @var \Illuminate\Database\Eloquent\Collection $plans */
    /** @var \App\Models\PaymentPlan $plan */
@endphp

<x-app-layout title="Editando plano de pagamento {{ $plan->name }}">

    <x-slot name="header">
        <div class="flex items-center justify-between">
            <x-header-text>Editando plano de pagamento {{ $plan->name }}</x-header-text>
        </div>
    </x-slot>

    <x-section>
        <livewire:payment-plan-form :plan="$plan"/>
    </x-section>

</x-app-layout>
