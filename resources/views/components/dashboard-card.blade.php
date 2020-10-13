<x-card>
    <div class="flex items-center p-4">
        <!-- Icon -->
        <div class="bg-logo w-12 h-12 rounded-md text-white flex items-center justify-center">
            {{ $icon }}
        </div>

        <!-- Stat -->
        <div class="ml-4">
            <div class="text-sm font-medium text-gray-500 uppercase">{{ $title }}</div>
            <div class="font-bold text-xl">{{ $stat }}</div>
        </div>
    </div>

    <!-- Action -->
    <div class="bg-orange-100 px-4 py-1">
        {{ $action }}
    </div>
</x-card>
