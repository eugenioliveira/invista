<div
        x-data
        x-init="IMask($refs.input, { mask: 'num', blocks: { num: { mask: Number, thousandsSeparator: '.' } } })"
        class="flex rounded-md shadow-sm"
>
    <span class="inline-flex items-center px-3 rounded-l-md border border-r-0 border-gray-300 bg-gray-50 text-gray-500 sm:text-sm">
        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
        </svg>
    </span>

    <input
            {{ $attributes }}
            x-ref="input"
            autocomplete="off"
            class="rounded-none rounded-r-md flex-1 form-input block w-full transition duration-150 ease-in-out sm:text-sm sm:leading-5"
    />

</div>