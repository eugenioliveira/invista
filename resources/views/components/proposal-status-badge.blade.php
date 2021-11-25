@php
/** @var \App\Models\LotStatus $status */
@endphp
<span {{ $attributes }} class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full uppercase {{ $classes }}">
    {{ $status->description }}
</span>
