<x-app-layout title="Gerenciar planos de pagamento do loteamento {{ $allotment->title }}">

    <x-slot name="header">
        <x-header-text>Gerenciar planos de pagamento do loteamento {{ $allotment->title }}</x-header-text>
    </x-slot>

    <x-section>
        <livewire:allotment-payment-plan-form :allotment="$allotment" />
    </x-section>

</x-app-layout>
