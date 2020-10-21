@props(['type' => 'success', 'message', 'autoclose' => true])

@php
    switch ($type) {
        case 'success':
            $title = 'Sucesso!';
            $colorClass = 'bg-green-500';
            break;
        case 'danger':
            $title = 'Ops!';
            $colorClass = 'bg-red-500';
            break;
        case 'warning':
            $title = 'Antenção!';
            $colorClass = 'bg-yellow-500';
            break;
    }
@endphp

<div
    x-data="{ show: true }"
    @if($autoclose)
    x-init="
        setInterval(function() {
            show = false;
        }, 3000);
    "
    @endif
>
    <div
        x-show="show"
        class="px-6 py-4 mb-6 rounded-lg {{ $colorClass }} text-white flex items-center justify-between"
        x-transition:enter="ease-in transform duration-300"
        x-transition:enter-start="scale-y-0 opacity-0"
        x-transition:enter-end="scale-y-100 opacity-100"
        x-transition:leave="ease-out transform duration-300"
        x-transition:leave-start="scale-y-100 opacity-100"
        x-transition:leave-end="scale-y-0 opacity-0"
    >
        <!-- Icon and text -->
        <div class="flex items-center">
            @switch($type)
                @case('success')
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                          d="M9 12l2 2 4-4M7.835 4.697a3.42 3.42 0 001.946-.806 3.42 3.42 0 014.438 0 3.42 3.42 0 001.946.806 3.42 3.42 0 013.138 3.138 3.42 3.42 0 00.806 1.946 3.42 3.42 0 010 4.438 3.42 3.42 0 00-.806 1.946 3.42 3.42 0 01-3.138 3.138 3.42 3.42 0 00-1.946.806 3.42 3.42 0 01-4.438 0 3.42 3.42 0 00-1.946-.806 3.42 3.42 0 01-3.138-3.138 3.42 3.42 0 00-.806-1.946 3.42 3.42 0 010-4.438 3.42 3.42 0 00.806-1.946 3.42 3.42 0 013.138-3.138z"></path>
                </svg>
                @break
                @case('danger')
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                </svg>
                @break
                @case('warning')
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                          d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path>
                </svg>
                @break
            @endswitch
            <p class="ml-4">
                <span class="font-bold">{{ $title }}</span> {{ $message }}
            </p>
        </div>
        <!-- Close button
        <div>
            <button @click="show = false" class="bg-transparent text-2xl font-semibold leading-none outline-none focus:outline-none">
                <span>×</span>
            </button>
        </div>-->
    </div>
</div>
