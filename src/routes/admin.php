<?php

use Illuminate\Support\Facades\Route;

Route::middleware(["web", "auth", "app-management"])
    ->prefix("admin")
    ->as("admin.")
    ->group(function () {
        Route::prefix("forms")
            ->as("forms.")
            ->group(function () {
                // Тут он не видит васад, поэтому просто создается экземпляр класса
                $facadeManagerClass = config("request-form.customFormActionsManager") ?? \GIS\RequestForm\Helpers\FormActionsManager::class;
                $manager = new $facadeManagerClass();
                $list = $manager->getRouteList();
                foreach ($list as $item) {
                    Route::get("/{$item->key}", function () use ($item) {
                        return $item->title;
                    })->name($item->key);
                }
            });
    });
