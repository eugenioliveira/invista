<x-input-row class="mb-6 items-center">
    <h2 class="text-lg uppercase tracking-widest">Permissões de acesso (Papel)</h2>
    <div class="flex-1 h-0.5 bg-gray-200"></div>
</x-input-row>

<x-input-row class="mb-6">
    <div class="flex justify-between w-2/4">
        @foreach(\App\Models\Role::all() as $role)
            <label class="flex items-center space-x-3">
                <input
                        type="radio"
                        name="role"
                        wire:model.lazy="state.role"
                        value="{{ $role->id }}"
                        class="appearance-none h-4 w-4 border border-orange-500 rounded-full checked:bg-primary checked:border-transparent focus:outline-none"
                >
                <span>{{ $role->label }}</span>
            </label>
        @endforeach
    </div>
</x-input-row>

@error('role')
<x-alert type="danger" :autoclose="false" message="{{ $message }}"></x-alert>
@enderror

@include('partials.role-description')