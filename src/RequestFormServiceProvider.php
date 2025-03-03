<?php

namespace GIS\RequestForm;

use GIS\RequestForm\Helpers\FormActionsManager;
use GIS\RequestForm\Livewire\Web\Forms\WebCallFormWire;
use Illuminate\Support\ServiceProvider;
use Livewire\Livewire;

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
        // Migrations
        $this->loadMigrationsFrom(__DIR__ . "/database/migrations");

        // Config
        $this->mergeConfigFrom(__DIR__ . "/config/request-form.php", "request-form");

        // Routes
        $this->loadRoutesFrom(__DIR__ . "/routes/admin.php");

        // Facades
        $this->initFacades();
    }

    protected function initFacades(): void
    {
        $this->app->singleton("form-actions", function () {
            $formActionsManagerClass = config("request-form.customFormActionsManager") ?? FormActionsManager::class;
            return new $formActionsManagerClass;
        });
    }

    protected function addLivewireComponents(): void
    {
        $component = config("request-form.customWebCallFormComponent");
        Livewire::component(
            "rf-web-call-form",
            $component ?? WebCallFormWire::class
        );
    }
}
