<?php

namespace App\Providers;

use App\Models\Device;
use App\Models\Playlist;
use App\Models\Slot;
use App\Policies\DevicePolicy;
use App\Policies\PlaylistPolicy;
use App\Policies\SlotPolicy;
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
        Slot::class => SlotPolicy::class,
        Playlist::class => PlaylistPolicy::class,
        Device::class => DevicePolicy::class
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        \Illuminate\Support\Facades\Auth::provider('custom', function($app, array $config) {
            return new CustomUserProvider($app['hash'], $config['model']);
        });
    }
}
