@props(['type' => 'text', 'label', 'name', 'error' => null, 'placeholder' => ''])

@php
    $labelClasses = $error ? 'text-red-500' : 'text-gray-700';
    $inputClasses = $error ? 'focus:ring focus:ring-red border-red-500' : 'focus:ring focus:ring-orange-500 focus:border-orange-300';
@endphp

<div>
    <label for="{{ $name }}" class="block font-medium text-sm text-gray-700 {{ $labelClasses }}">{{ $label }}</label>
    <input
            id="{{ $name }}"
            name="{{ $name }}"
            type="{{ $type }}"
            {{ $attributes->merge(['class' => 'border rounded-lg px-3 py-2 appearance-none focus:outline-none ' . $inputClasses]) }}
            autocomplete="off"
            placeholder="{{ $placeholder }}"
    />
    <div>
        @if($error)
            <div class="mt-1 flex items-center">
                <span class="font-medium text-red-500 text-xs">{{ $error }}</span>
            </div>
        @endif
    </div>
</div>
