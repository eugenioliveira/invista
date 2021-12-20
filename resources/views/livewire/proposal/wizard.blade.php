<div>
    <div class="rounded-md shadow overflow-hidden max-w-3xl mx-auto">
        <!-- Header -->
        <div class="bg-primary border-b-2 border-gray-500 p-4">
            <h1 class="text-white font-bold">{{ $steps[$currentStep]['heading'] }}</h1>
            <h4 class="text-white text-sm opacity-90">{{ $steps[$currentStep]['subheading'] }}</h4>
        </div>

        <!-- Body -->
        <div class="bg-white">
            @livewire($steps[$currentStep]['component'])
        </div>

        <!-- Footer -->
        <div class="p-4 bg-gray-100 border-t-2 border-gray-500 flex justify-around">
            Teste
        </div>
    </div>
</div>
