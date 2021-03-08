<?php

namespace App\Providers;

use App\PaymentGatewayManager;
use App\Services\FakePaymentGateway;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\ParallelTesting;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton(PaymentGatewayManager::class);

        if ($this->app->environment('testing', 'local')) {
            $this->app->make(PaymentGatewayManager::class)->extend(
                'fake',
                $this->app->factory(FakePaymentGateway::class)
            );
        }
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        JsonResource::withoutWrapping();

        ParallelTesting::setUpTestDatabase(function ($database, $token) {
            Artisan::call('db:seed');
        });
    }
}
