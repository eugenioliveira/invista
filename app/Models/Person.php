<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Hash;

class Person extends Model
{
    use HasFactory;

    /**
     * Retorna o usuário pertencente a pessoa.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function user()
    {
        return $this->hasOne(User::class);
    }

    /**
     * Retorna o endereço da pessoa.
     *
     * @return \Illuminate\Database\Eloquent\Relations\MorphOne
     */
    public function address()
    {
        return $this->morphOne(Address::class, 'addressable');
    }

    /**
     * Salva um usuário para a pessoa.
     *
     * @param $email
     * @param null $password
     * @return false|Model
     */
    public function saveUser($email, $password = null)
    {
        $user = $this->user ?? new User();
        $user->name = $this->firstname . ' ' . $this->lastname;
        $user->email = $email;
        $user->password = $password ? Hash::make($password) : $user->password;

        return $this->user()->save($user);
    }
}
