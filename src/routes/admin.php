<?php

use Illuminate\Support\Facades\Route;
use GIS\RequestForm\Http\Controllers\Admin\FormController;

Route::middleware(["web", "auth", "app-management"])
    ->prefix("admin")
    ->as("admin.")
    ->group(function () {
        Route::prefix("forms")
            ->as("forms.")
            ->group(function () {
                $controllerClass = config("request-form.customFormAdminController") ?? FormController::class;
                Route::get("/{key}", [$controllerClass, "show"])->name("show");
            });
    });
