@props(['label', 'name', 'error' => null])

@php
    $labelClasses = $error ? 'text-red-500' : 'text-gray-700';
    $inputClasses = $error ? 'focus:shadow-outline-red border-red-500' : 'focus:shadow-outline-orange focus:border-orange-300';
@endphp

<div class="w-full">
    <label for="{{ $name }}" class="block font-medium text-sm text-gray-700 {{ $labelClasses }}">{{ $label }}</label>
    <select
        id="{{ $name }}"
        name="{{ $name }}"
        {{ $attributes->merge(['class' => 'bg-white border rounded-lg px-3 py-2 leading-tight focus:outline-none ' . $inputClasses]) }}
        style="height: 43px"
    >
        {{ $slot }}
    </select>
    @if($error)
        <div class="mt-1 flex items-center">
            <span class="font-medium text-red-500 text-xs">{{ $error }}</span>
        </div>
    @endif
</div>
