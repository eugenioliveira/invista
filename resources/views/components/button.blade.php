<button {{ $attributes->merge(['type' => 'submit', 'class' => 'inline-flex items-center px-4 py-2 bg-primary border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-yellow-500 active:bg-yellow-600 focus:outline-none focus:border-orange-600 focus:ring focus:ring-yellow-600 disabled:opacity-25 transition ease-in-out duration-150']) }}>
    {{ $slot }}
</button>
