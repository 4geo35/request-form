<?php

namespace GIS\RequestForm\Helpers;

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

    protected function makeFormRouteItem(array $data, array &$result): void
    {
        foreach ($data as $key => $title) {
            $result[] = (object) [
                "key" => $key,
                "title" => $title,
                "routeName" => "admin.forms.{$key}",
            ];
        }
    }
}
