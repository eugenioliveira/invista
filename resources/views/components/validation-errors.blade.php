@if ($errors->any())
    <div {{ $attributes->merge(['class'=> 'bg-red-100 border-l-4 border-red-500 text-red-700 p-4']) }}>
        <div class="font-medium">Ops! algo deu errado.</div>

        <ul class="mt-3 list-disc list-inside text-sm">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
