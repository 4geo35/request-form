<?php

namespace GIS\RequestForm\Helpers;

use Illuminate\Support\Facades\Route;

class FormActionsManager
{
    public function getFormList(): array
    {
        $array = [];
        if (! empty(config("request-form.availableForms"))) {
            $this->makeFormListItem(config("request-form.availableForms"), $array);
        }
        if (! empty(config("request-form.customAvailableForms"))) {
            $this->makeFormListItem(config("request-form.customAvailableForms"), $array);
        }
        return $array;
    }

    public function getTitleByKey(string $key): string
    {
        if (! empty(config("request-form.availableForms")[$key])) {
            return config("request-form.availableForms")[$key];
        }
        if (! empty(config("request-form.customAvailableForms")[$key])) {
            return config("request-form.customAvailableForms")[$key];
        }
        return "Неизвестно";
    }

    public function getComponentByKey(string $key): string
    {
        if (isset(config("request-form.formComponents")[$key])) {
            return config("request-form.formComponents")[$key];
        }
        if (isset(config("request-form.customFormComponents")[$key])) {
            return config("request-form.customFormComponents")[$key];
        }
        return ""; // TODO: add error component
    }

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
        if (isset(config("request-form.formItems")[$key])) return config("request-form.formItems")[$key];
        if (isset(config("request-form.customFormItems")[$key])) return config("request-form.customFormItems")[$key];
        return ""; // TODO: add error view
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

    protected function makeFormListItem(array $data, array &$result): void
    {
        foreach ($data as $key => $title) {
            $result[] = (object) [
                "key" => $key,
                "title" => $title,
            ];
        }
    }
}
