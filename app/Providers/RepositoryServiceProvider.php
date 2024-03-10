<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Contracts\OrderContract;
use App\Repositories\OrderRepository;

class RepositoryServiceProvider extends ServiceProvider
{
    protected $repositories = [
        OrderContract::class => OrderRepository::class,
    ];

    /**
     * Register services.
     */
    public function register(): void
    {
        foreach ($this->repositories as $interface => $implementation)
        {
            $this->app->bind($interface, $implementation);
        }
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
