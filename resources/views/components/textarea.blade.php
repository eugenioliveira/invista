@php
    $labelClasses = $error ? 'text-red-500' : 'text-gray-700';
    $inputClasses = $error ? 'focus:shadow-outline-red border-red-500' : 'focus:shadow-outline-orange focus:border-orange-300';
@endphp

<div>
    <label for="{{ $name }}" class="block font-medium text-sm text-gray-700 {{ $labelClasses }}">{{ $label }}</label>
    <textarea
        id="{{ $name }}"
        name="{{ $name }}"
        {{ $attributes->merge(['class' => 'border rounded-lg px-3 py-2 appearance-none focus:outline-none ' . $inputClasses]) }}
    >
        {{ $slot }}
    </textarea>
    @if($error)
        <div class="mt-1 flex items-center">
            <span class="font-medium text-red-500 text-xs">{{ $error }}</span>
        </div>
    @endif
</div>
