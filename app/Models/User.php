<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Str;
use Laravel\Fortify\TwoFactorAuthenticatable;
use Laravel\Jetstream\HasProfilePhoto;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens;
    use HasFactory;
    use HasProfilePhoto;
    use Notifiable;
    use TwoFactorAuthenticatable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['name', 'email', 'password'];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = ['password', 'remember_token', 'two_factor_recovery_codes', 'two_factor_secret', 'pivot'];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime'
    ];

    /**
     * The accessors to append to the model's array form.
     *
     * @var array
     */
    protected $appends = ['profile_photo_url'];

    /**
     * Métodos mágicos pertinentes ao Model
     *
     * @param string $method
     * @param array $parameters
     * @return bool|mixed
     */
    public function __call($method, $parameters)
    {
        if (Str::startsWith($method, 'is')) {
            return $this->hasRole(Str::lower(Str::remove('is', $method)));
        }

        return parent::__call($method, $parameters);
    }

    /**
     * Get the default profile photo URL if no profile photo has been uploaded.
     *
     * @return string
     */
    protected function defaultProfilePhotoUrl()
    {
        return 'https://ui-avatars.com/api/?name=' . urlencode($this->name) . '&color=FFFFFF&background=253C78';
    }

    /**
     * Os papéis que o usuário possui.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function roles()
    {
        return $this->belongsToMany(Role::class);
    }

    /**
     * Os loteamentos permitidos para o usuário.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function allotments()
    {
        return $this->belongsToMany(Allotment::class);
    }

    /**
     * A pessoa a qual o usuário pertence.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function person()
    {
        return $this->belongsTo(Person::class);
    }

    /**
     * Atribui um novo papel para o usuário.
     *
     * @param mixed $role
     */
    public function assignRole($role)
    {
        if (is_string($role) && !is_numeric($role)) {
            $role = Role::whereName($role)->firstOrFail();
        }

        $this->roles()->sync($role);
    }

    /**
     * Busca as permissões do usuário.
     *
     * @return Collection
     * @throws \Exception
     */
    public function permissions(): Collection
    {
        /*return Cache::remember('User' . $this->id . 'Permissions', now()->addDay(), function() {
            return $this->roles
                ->map->permissions
                ->flatten()->pluck('name')->unique();
        });*/

        return $this->roles->map->permissions
            ->flatten()
            ->pluck('name')
            ->unique();
    }

    /**
     * Certifica se o usuário possui determinado papel.
     *
     * @param $role
     * @return mixed
     */
    public function hasRole($role): bool
    {
        $userRoles = $this->roles()->pluck('name');
        /*$userRoles = Cache::remember('User' . $this->id . 'Roles', now()->addDay(), function () {
            return $this->roles()->pluck('name');
        });*/

        return $userRoles->contains($role);
    }

    /**
     * Retorna as reservas feitas pelo usuário atual.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function reservations()
    {
        return $this->hasMany(Reservation::class);
    }

    /**
     * Retorna as propostas feitas pelo usuário atual.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function proposals()
    {
        return $this->hasMany(Proposal::class);
    }
}
