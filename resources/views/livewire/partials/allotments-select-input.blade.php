<div>
    @can('allow_brokers')
        @if ($state['role'] == \App\Models\Role::BROKER)
            <x-input-row class="mb-6 items-center">
                <h2 class="text-lg uppercase tracking-widest">Loteamentos permitidos</h2>
                <div class="flex-1 h-0.5 bg-gray-200"></div>
            </x-input-row>

            <div x-data="{
                init() {
                    this.select2 = $(this.$refs.select).select2({
                        placeholder: 'Clique aqui para selecionar um loteamento...',
                        width: '100%'
                    });
                    @if(isset($userAllotments))
                    this.select2.val(@this.userAllotments);
                    this.select2.trigger('change');
                    @endif
                    this.select2.on('change', (event) => {
                        @this.set('state.selected_allotments', this.select2.select2('val'));
                    });
                }
            }">
                <div class='w-full' wire:ignore>
                    <select x-ref="select" multiple>
                        <option></option>
                        @foreach($allotments as $allotment)
                            <option value="{{ $allotment->id }}">{{ $allotment->title }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
        @endif
    @endcan
</div>