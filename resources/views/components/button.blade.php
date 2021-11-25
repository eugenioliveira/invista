<button {{ $attributes(['type' => 'submit', 'class' => 'inline-flex items-center p-2 bg-primary border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-orange-400 active:bg-orange-600 focus:outline-none focus:border-orange-600 focus:ring focus:ring-orange-500 disabled:opacity-25 transition ease-in-out duration-150']) }}>
    {{ $slot }}
</button>
