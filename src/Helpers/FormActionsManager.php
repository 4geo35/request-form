<?php

namespace GIS\RequestForm\Helpers;

use Illuminate\Support\Facades\Route;

class FormActionsManager
{
    public function prepareValidation(array $data): array
    {
        foreach ($data as &$value) {
            foreach ($value as &$rule) {
                if (! is_string($rule)) { continue; }
                if (! str_starts_with($rule, "email")) { continue; }
                $exploded = explode(":", $rule);
                if (count($exploded) > 1) {
                    $additional = explode(",", $exploded[1]);
                    if (! in_array("dns", $additional)) { $additional[] = "dns"; }
                } else { $additional = ["dns"]; }
                $rule = implode(":", [$exploded[0], implode(",", $additional)]);
            }
        }
        if (empty($data["hidden"])) {
            $data["hidden"] = ["nullable", "prohibited"];
        }
        return $data;
    }

    public function getFormList(): array
    {
        $array = [];
        $exceptions = ! empty(config("request-form.externalExceptions")) ? config("request-form.externalExceptions") : [];
        if (! empty(config("request-form.availableForms"))) {
            $this->makeFormListItem(config("request-form.availableForms"), $array, $exceptions);
        }
        if (! empty(config("request-form.customAvailableForms"))) {
            $this->makeFormListItem(config("request-form.customAvailableForms"), $array, $exceptions);
        }
        return $array;
    }

    public function getTitleByKey(string $key): string
    {
        $info = $this->getInfoByKey($key);
        if (empty($info)) { return "Неизвестно"; }
        return $info["title"];
    }

    public function getRowsTemplateByKey(string $key): string
    {
        $info = $this->getInfoByKey($key);
        if (empty($info)) { return ""; }
        return $info["notificationRow"];
    }

    public function getComponentByKey(string $key): string
    {
        $info = $this->getInfoByKey($key);
        if (empty($info)) { return ""; } // TODO: add error component
        return $info["component"];
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
        $info = $this->getInfoByKey($key);
        if (empty($info)) { return ""; } // TODO: add error view
        return $info["admin"];
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

    protected function getInfoByKey(string $key): ?array
    {
        if (! empty(config("request-form.availableForms")[$key])) {
            return config("request-form.availableForms")[$key];
        }
        if (! empty(config("request-form.customAvailableForms")[$key])) {
            return config("request-form.customAvailableForms")[$key];
        }
        return null;
    }

    protected function makeFormRouteItem(array $data, array &$result): void
    {
        foreach ($data as $key => $info) {
            $result[] = (object) [
                "key" => $key,
                "title" => $info["title"],
                "routeName" => "admin.forms.show",
            ];
        }
    }

    protected function makeFormListItem(array $data, array &$result, array $exceptions = []): void
    {
        foreach ($data as $key => $info) {
            if (in_array($key, $exceptions)) { continue; }
            $result[] = (object) [
                "key" => $key,
                "title" => $info["title"],
            ];
        }
    }
}
