@props(['label','name','model','error'])
<div x-data="{
    init() {
        IMask($refs.{{ $name }}, {
            mask: 'num',
            blocks: {
                num: {
                    mask: Number,
                    thousandsSeparator: '.'
                }
            }
        });
    }
 }">
    <x-input
            :label="$label"
            :name="$name"
            class="mt-1 w-full"
            wire:model="{{ $model }}"
            x-ref="{{ $name }}"
            :error="$error"
    />
</div>