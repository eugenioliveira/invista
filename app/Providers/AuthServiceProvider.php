<?php

namespace App\Providers;

use App\Models\User;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Gate;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        // 'App\Models\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        /*
         * Regra de autorização do admin
         *
         * Todas as permissões menos a de resolver propostas
         */
        Gate::before(function (User $user, $permission) {
            if (
                $user->isAdmin() &&
                !in_array($permission, ['resolve', 'editProposal', 'changeLotStatus', 'createSale'])
            ) {
                return true;
            }
        });

        /*
         * Caso o usuário não for admin,
         * prossegue com a verificação de papéis e permissões
         */
        Gate::before(function (User $user, $permission) {
            if ($user->permissions()->contains($permission)) {
                return true;
            }
        });
    }
}
