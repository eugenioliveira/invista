<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Hash;

class Person extends Model
{
    use HasFactory;

    protected $guarded = [];

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
     * Retorna os detalhes da pessoa.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function detail()
    {
        return $this->hasOne(PersonDetail::class);
    }

    /**
     * Salva um usuário para a pessoa.
     *
     * @param $email
     * @param null $password
     * @return false|User
     */
    public function saveUser($email, $password = null)
    {
        $user = $this->user ?? new User();
        $user->name = $this->full_name;
        $user->email = $email;
        $user->password = $password ? Hash::make($password) : $user->password;

        return $this->user()->save($user);
    }

    /**
     * Salva os detalhes da pessoa.
     *
     * @param PersonDetail $detail
     * @return false|Model
     */
    public function saveDetail(PersonDetail $detail)
    {
        return $this->detail()->save($detail);
    }

    /**
     * Retorna o nome completo da pessoa.
     *
     * @return string
     */
    public function getFullNameAttribute(): string
    {
        return sprintf('%s %s', $this->first_name, $this->last_name);
    }
}
