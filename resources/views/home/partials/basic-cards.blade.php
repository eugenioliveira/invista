<div class='grid grid-cols-1 md:grid-cols-3 gap-4'>
    <div class='border border-primary rounded-lg bg-white shadow'>
        <div class='space-y-3 py-4'>
            <!-- Title -->
            <div class='px-4'>
                <h1 class='text-2xl font-medium text-primary'><a href='{{ route('reservations.index') }}' class='hover:underline'>Minhas reservas</a>
                </h1>
            </div>

            <!-- Image -->
            <div class='px-4'>
                <div class='rounded-lg overflow-auto shadow'>
                    <img src='{{ asset('img/reservations.jpg') }}' />
                </div>
            </div>

            <!-- Action -->
            <div class='bg-gray-200 px-4 py-2'>
                @if($reservationsCount > 0)
                    <p>
                        Você possui {{ $reservationsCount }} reservas ativas.
                        <a href='{{ route('reservations.index') }}' class='font-medium text-primary hover:underline'>Ver reservas</a>
                    </p>
                @else
                    Você não possui nenhuma reserva ativa.
                @endif
            </div>
        </div>
    </div>

    <div class='border border-primary rounded-lg bg-white shadow'>
        <div class='space-y-3 py-4'>
            <!-- Title -->
            <div class='px-4'>
                <h1 class='text-2xl font-medium text-primary'><a href='{{ route('proposals.index') }}' class='hover:underline'>Minhas propostas</a>
                </h1>
            </div>

            <!-- Image -->
            <div class='px-4'>
                <div class='rounded-lg overflow-auto shadow'>
                    <img src='{{ asset('img/proposals.jpg') }}' />
                </div>
            </div>

            <!-- Action -->
            <div class='bg-gray-200 px-4 py-2'>
                @if($proposalsCount > 0)
                    <p>
                        Você possui {{ $proposalsCount }} propostas ativas.
                        <a href='{{ route('proposals.index') }}' class='font-medium text-primary hover:underline'>Ver propostas</a>
                    </p>
                @else
                    Você não possui nenhuma proposta ativa.
                @endif
            </div>
        </div>
    </div>
</div>