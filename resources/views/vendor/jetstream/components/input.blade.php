@props(['disabled' => false])

<input {{ $disabled ? 'disabled' : '' }} {!! $attributes->merge(['class' => 'my-form-input rounded-md shadow-sm']) !!}>
