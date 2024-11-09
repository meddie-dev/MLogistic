<?php

namespace App\Providers;

use App\Models\AuthLog;
use Illuminate\Auth\Events\Login;
use Illuminate\Auth\Events\Logout;
use Illuminate\Support\Facades\Event;
use Illuminate\Support\ServiceProvider;
use App\Models\Supplier;
use App\Policies\SupplierPolicy;

class AppServiceProvider extends ServiceProvider
{
    protected $policies = [
        Supplier::class => SupplierPolicy::class,
    ];

    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */


    public function boot(): void
    {
        
           // Listen for the login event
           Event::listen(Login::class, function ($event) {
            AuthLog::create([
                'user_id' => $event->user->id,
                'event' => 'login',
                'ip_address' => request()->ip(), // Capture the user's IP address
            ]);
        });

        // Listen for the logout event
        Event::listen(Logout::class, function ($event) {
            AuthLog::create([
                'user_id' => $event->user->id,
                'event' => 'logout',
                'ip_address' => request()->ip(),
            ]);
        });
    }
}
