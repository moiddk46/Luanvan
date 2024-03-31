<?php

namespace App\Providers;

use App\Models\orderModel;
use Illuminate\Support\ServiceProvider;
use App\Models\ServiceMaster;
use Illuminate\Support\Facades\Auth;
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
        $header = $this->service->getServiceMaster();

        View::share('header', $header);
    }
}
