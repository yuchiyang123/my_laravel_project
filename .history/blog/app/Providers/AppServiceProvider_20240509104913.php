<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Carbon\Carbon;

use App\Permission;
use Illuminate\Auth\Access\Gate as AccessGate;
use Illuminate\Contracts\Auth\Access\Gate as GateContract;
use Illuminate\Support\Facades\Gate;
use Sentinel;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register()
    {
        $this->registerAccessGate();
    }

    protected function registerAccessGate()
    {
        $this->app->singleton(GateContract::class, function ($app) {
            return new AccessGate($app, function () {
                return $this->app['sentinel']->getUser();
            });
        });
    }

    public function registerPolicies()
    {
        // Define gate
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        $this->registerPolicies();
        //
        Carbon::setLocale('zh-tW');
    }
}
