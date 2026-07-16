<?php

namespace App\Providers;

use App\Interfaces\EnterpriseServiceInterface;
use App\Services\EnterpriseService;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->bind(EnterpriseServiceInterface::class, EnterpriseService::class);
    }

    public function boot(): void {}
}
