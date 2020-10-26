@php
    /** @var \App\Models\Lot $lot */
@endphp
<div>
    <!-- Success message -->
    @if(session('successMessage'))
        <x-alert type="success" message="{{ session('successMessage') }}"/>
    @endif

    <!-- Search and Pagination -->
    <x-search-pagination search-placeholder="Ex.: A25" :collection="$lots"/>

    <!-- Lots table -->
    <x-card class="my-4 p-4">
        <table class="min-w-full divide-y divide-gray-200">
            <thead>
            <tr>
                <th class="px-6 py-3 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">
                    Identificação
                </th>
                <th class="px-6 py-3 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">
                    Preço
                </th>
                <th class="px-6 py-3 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">
                    Área total
                </th>
                <th class="px-6 py-3 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">
                    Status
                </th>
                <th class="px-6 py-3 bg-gray-50"></th>
            </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
            @foreach($lots as $lot)
                <tr>
                    <!-- Ident -->
                    <td class="px-6 py-4 whitespace-no-wrap">
                        {{ $lot->identification }}
                    </td>
                    <!-- Price -->
                    <td class="px-6 py-4 whitespace-no-wrap">
                        {{ $lot->price }}
                    </td>
                    <!-- Area -->
                    <td class="px-6 py-4 whitespace-no-wrap">
                        {{ $lot->area }} m<sup>2</sup>
                    </td>
                    <!-- Status -->
                    <td class="px-6 py-4 whitespace-no-wrap text-sm leading-5 text-gray-500">
                        <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">
                            Active
                        </span>
                    </td>
                    <!-- Actions -->
                    <td class="px-6 py-4 whitespace-no-wrap text-right text-sm leading-5 font-medium">

                    </td>
                </tr>
            @endforeach

            <!-- More rows... -->
            </tbody>
        </table>
    </x-card>

</div>
