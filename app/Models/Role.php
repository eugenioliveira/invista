<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    const ADMIN = 1;
    const SUPERVISOR = 2;
    const BROKER = 3;
    /**
     * Desabilita a proteção contra mass assignment
     * uma vez que os campos serão validados.
     *
     * @var array
     */
    protected $guarded = [];

    /**
     * As permissões associadas à esse papel.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function permissions()
    {
        return $this->belongsToMany(Permission::class);
    }

    /**
     * Os usuários que possuem esse papel.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function users()
    {
        return $this->belongsToMany(User::class);
    }

    /**
     * Concede uma permissão a um papel.
     *
     * @param mixed $permission
     * @return Role
     */
    public function allowTo($permission)
    {
        if (is_string($permission)) {
            $permission = Permission::whereName($permission)->firstOrFail();
        }

        $this->permissions()->sync($permission, false);

        return $this;
    }
}
