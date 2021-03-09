<?php

namespace App\Providers;

use App\Models\Broadcast;
use App\Models\Publisher;
use App\Policies\BroadcastPolicy;
use App\Policies\PublisherPolicy;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        Publisher::class => PublisherPolicy::class,
        Broadcast::class => BroadcastPolicy::class
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        //
    }
}
