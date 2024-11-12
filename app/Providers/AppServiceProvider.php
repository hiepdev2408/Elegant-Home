<?php

namespace App\Providers;

use App\Http\Controllers\Account\AccountController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Client\HomeController;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

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
        View::composer('admin.layouts.partials.menu', DashboardController::class);
        View::composer('client.layouts.partials.header', HomeController::class);

    }

}
