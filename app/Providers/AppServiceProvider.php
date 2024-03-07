<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Models\ServiceMaster;
use Illuminate\Support\Facades\View;

class AppServiceProvider extends ServiceProvider
{
    private $service;
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
        $this->service = new ServiceMaster;
        $data = $this->service->getServiceMaster();
        View::share('data', $data);     
    }
}
