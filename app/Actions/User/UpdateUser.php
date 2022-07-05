<?php

namespace App\Actions\User;

use App\Models\Role;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class UpdateUser
{
    public function update(User $user, array $input)
    {
        $validated = Validator::make($input, [
            'email' => ['required', 'email:strict,dns,spoof', Rule::unique('users', 'email')->ignore($user->id)],
            'password' => ['nullable', 'min:8', 'confirmed'],
            'role' => ['required', 'exists:roles,id'],
            'creci' => ['nullable']
        ])->validate();

        $user->email = $validated['email'];
        $user->password = $validated['password'] ? Hash::make($validated['password']) : $user->password;
        $user->creci = isset($validated['creci']) ? $validated['creci'] : null;
        $user->save();
        $user->assignRole($validated['role']);
        if ($validated['role'] != Role::ADMIN) {
            $user->allotments()->sync($input['selected_allotments']);
        }
    }
}
