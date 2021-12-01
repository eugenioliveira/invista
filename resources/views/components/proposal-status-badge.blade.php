@php
    /** @var \App\Models\LotStatus $status */
@endphp
<div x-data >
    <button type="button" @click="$dispatch('show-reason-modal', '{{ $reason }}')">
        <span {{ $attributes }} class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full uppercase {{ $classes }}">
        {{ $status->description }}
        </span>
    </button>
</div>