<?php

namespace App\Providers;

use App\Models\RoleMenu;
use App\Models\User;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\View;
use Yajra\DataTables\Html\Builder;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Builder::useVite();
        Gate::define('viewPulse', function (User $user) {
            return true;
        });

        View::composer('*', function () {
            if (auth()->check()){
                $roleMenus = RoleMenu::join('menus', 'menus.id', 'role_menus.menu_id')
                                        ->when(!auth()->user()->hasRole('superadmin'), function($q){
                                            return $q->where('role_id', auth()->user()->roles->first()->id);
                                        })
                                        ->get();

                View::share('roleMenus', $roleMenus);
                View::share('key', 'value');
            }
        });
    }
}
