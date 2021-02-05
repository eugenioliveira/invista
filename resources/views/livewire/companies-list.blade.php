@php
    /** @var \Illuminate\Database\Eloquent\Collection $companies */
    /** @var \App\Models\Company $company */
@endphp

<div>
    <!-- Success message -->
    @if(session('successMessage'))
        <x-alert type="success" message="{{ session('successMessage') }}"/>
@endif

<!-- Search and Pagination -->
    <x-search-pagination search-placeholder="Ex.: Nome, CNPJ" :links="$companies->links()"/>

    <div class="flex flex-col">
        <div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
            <div class="py-2 align-middle inline-block min-w-full sm:px-6 lg:px-8">
                <div class="shadow overflow-hidden border-b border-gray-200 sm:rounded-lg">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead>
                        <tr>
                            <th class="px-6 py-3 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">
                                CNPJ
                            </th>
                            <th class="px-6 py-3 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">
                                Nome
                            </th>
                            <th class="px-6 py-3 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">
                                Telefone
                            </th>
                            <th class="px-6 py-3 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">
                                Sócio(s) cadastrado(s)?
                            </th>
                            <th class="px-6 py-3 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">
                                Possui endereço?
                            </th>
                            <th class="px-6 py-3 bg-gray-50"></th>
                        </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                        @foreach($companies as $company)
                            <tr>
                                <td class="px-6 py-4 whitespace-no-wrap">
                                    <div class="text-sm leading-5 text-gray-900">{{ $company->cnpj }}</div>
                                </td>
                                <td class="px-6 py-4 whitespace-no-wrap font-medium">
                                    <div class="text-sm leading-5 text-gray-900">{{ $company->name }}</div>
                                </td>
                                <td class="px-6 py-4 whitespace-no-wrap">
                                    <div class="text-sm leading-5 text-gray-900">{{ $company->phone }}</div>
                                </td>
                                <td class="px-6 py-4 whitespace-no-wrap">
                                    @if($company->shareholders->isNotEmpty())
                                        <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">
                                            Sim
                                        </span>
                                    @else
                                        <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-red-100 text-red-800">
                                            Não
                                        </span>
                                    @endif
                                </td>
                                <td class="px-6 py-4 whitespace-no-wrap">
                                    @if($company->address)
                                        <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">
                                            Sim
                                        </span>
                                    @else
                                        <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-red-100 text-red-800">
                                            Não
                                        </span>
                                    @endif
                                </td>
                                <td class="px-6 py-4 whitespace-no-wrap text-right text-sm leading-5 font-medium">
                                    <!-- Edit action -->
                                    <x-button-link href="{{ route('company.edit', $company->id) }}" format="icon" title="Editar">
                                        <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                            <path
                                                    d="M13.586 3.586a2 2 0 112.828 2.828l-.793.793-2.828-2.828.793-.793zM11.379 5.793L3 14.172V17h2.828l8.38-8.379-2.83-2.828z"></path>
                                        </svg>
                                    </x-button-link>
                                    <!-- Edit shareholders action -->
                                    <x-button-link href="#" format="icon" title="Editar sócios">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path></svg>
                                    </x-button-link>
                                    <!-- Edit address action -->
                                    <x-button-link href="#" format="icon" title="Editar endereço">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                  d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                        </svg>
                                    </x-button-link>
                                </td>
                            </tr>
                        @endforeach
                        <!-- More rows... -->
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

</div>