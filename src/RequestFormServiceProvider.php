<?php

namespace GIS\RequestForm;

use GIS\RequestForm\Helpers\FormActionsManager;
use GIS\RequestForm\Livewire\Admin\Forms\CallTableWire;
use GIS\RequestForm\Livewire\Web\Forms\WebCallFormWire;
use GIS\RequestForm\Models\RequestForm;
use GIS\RequestForm\Observers\RequestFormObserver;
use Illuminate\Support\ServiceProvider;
use Livewire\Livewire;

class RequestFormServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->loadMigrationsFrom(__DIR__ . "/database/migrations");
        $this->mergeConfigFrom(__DIR__ . "/config/request-form.php", "request-form");
        $this->initFacades();
    }

    public function boot(): void
    {
        $this->loadViewsFrom(__DIR__ . "/resources/views", "rf");
        $this->loadRoutesFrom(__DIR__ . "/routes/admin.php");

        $this->observeModels();
        $this->addLivewireComponents();
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

        $component = config("request-form.customAdminCallTableComponent");
        Livewire::component(
            "rf-admin-call-table",
            $component ?? CallTableWire::class
        );
    }

    protected function observeModels(): void
    {
        $formObserverClass = config("request-form.customRequestFormModelObserver") ?? RequestFormObserver::class;
        $formModelClass = config("request-form.customRequestFormModel") ?? RequestForm::class;
        $formModelClass::observe($formObserverClass);
    }
}
