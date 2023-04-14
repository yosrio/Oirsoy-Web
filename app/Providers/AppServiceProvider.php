<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Models\User;
use App\Models\Sidebar;
use App\Models\Roles;
use Illuminate\Support\Facades\Auth;

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
        // Default data
        view()->composer('*', function ($view) {
            if (Auth::check()) {
                $user = Auth::user();
                $userRoles = Roles::where('id', $user->role_id)->first();
                $sidebar = Sidebar::orderBy('sort_order')->get();
                $view
                    ->with('user', $user)
                    ->with('sidebar', $sidebar)
                    ->with('userRoles', $userRoles);
            }
        });
    }
}
