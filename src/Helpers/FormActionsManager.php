<?php

namespace GIS\RequestForm\Helpers;

use Illuminate\Support\Facades\Route;

class FormActionsManager
{
    public function getRouteList(): array
    {
        $array = [];
        if (! empty(config("request-form.availableForms"))) {
            $this->makeFormRouteItem(config("request-form.availableForms"), $array);
        }
        if (! empty(config("request-form.customAvailableForms"))) {
            $this->makeFormRouteItem(config("request-form.customAvailableForms"), $array);
        }
        return $array;
    }

    public function getRouteNameList(): array
    {
        $result = [];
        $list = $this->getRouteList();
        foreach ($list as $item) {
            $result[] = $item->routeName;
        }
        return $result;
    }

    public function checkIfAvailable(string $key): bool
    {
        if (isset(config("request-form.availableForms")[$key])) return true;
        if (isset(config("request-form.customAvailableForms")[$key])) return true;
        return false;
    }

    public function getAdminViewByKey(string $key): string
    {
        if (! isset(config("request-form.formItems")[$key]["admin"])) return ""; // TODO: add error view
        return config("request-form.formItems")[$key]["admin"];
    }

    public function checkIfMenuIsActive(): bool
    {
        $currentRouteName = Route::currentRouteName();
        return in_array($currentRouteName, $this->getRouteNameList());
    }

    public function checkIfMenuItemIsActive(string $key): bool
    {
        if (! $this->checkIfMenuIsActive()) return false;
        $routeParameters = Route::current()->parameters();
        if (empty($routeParameters["key"])) return false;
        $currentKey = $routeParameters["key"];
        return $currentKey === $key;
    }

    protected function makeFormRouteItem(array $data, array &$result): void
    {
        foreach ($data as $key => $title) {
            $result[] = (object) [
                "key" => $key,
                "title" => $title,
                "routeName" => "admin.forms.show",
            ];
        }
    }
}
