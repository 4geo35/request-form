<?php

use Illuminate\Support\Facades\Route;

Route::middleware(["web", "auth", "app-management"])
    ->prefix("admin")
    ->as("admin.")
    ->group(function () {
        Route::prefix("forms")
            ->as("forms.")
            ->group(function () {
                Route::get("/", function () {
                    return "Forms";
                });
            });
    });
