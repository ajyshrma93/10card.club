<?php

namespace App\Providers;

use App\Models\User;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\ServiceProvider;
use View;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot(User $user)
    {
        Paginator::useBootstrap();
        $users = $user->with(['user_type', 'bank_admin' => function ($query) {
            $query->with('bank');
        }])->get();
        View::share('users', $users->toArray());
    }
}
