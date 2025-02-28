<?php

namespace GIS\RequestForm;

use Illuminate\Support\ServiceProvider;

class RequestFormServiceProvider extends ServiceProvider
{
    public function boot(): void
    {
        // Views
        $this->loadViewsFrom(__DIR__ . "/resources/views", "rf");

        // Livewire
        $this->addLivewireComponents();
    }

    public function register(): void
    {

    }

    protected function addLivewireComponents(): void
    {
        // Migrations
        $this->loadMigrationsFrom(__DIR__ . "/database/migrations");

        // Config
        $this->mergeConfigFrom(__DIR__ . "/config/request-form.php", "request-form");

        // Routes
        $this->loadRoutesFrom(__DIR__ . "/routes/admin.php");
    }
}
