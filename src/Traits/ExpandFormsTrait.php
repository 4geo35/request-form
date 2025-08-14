<?php

namespace GIS\RequestForm\Traits;

trait ExpandFormsTrait
{
    protected function expandForms(array $config): void
    {
        if (empty($config['availableForms'])) { return; }
        $rf = app()->config["request-form"];
        $availableForms = $rf["availableForms"];
        foreach ($config["availableForms"] as $key => $form) {
            $availableForms[$key] = $form;
        }
        app()->config["request-form.availableForms"] = $availableForms;

        if (empty($config["formExternalExceptions"])) { return; }
        $exceptions = $rf["externalExceptions"];
        foreach ($config["formExternalExceptions"] as $exception) { $exceptions[] = $exception; }
        app()->config["request-form.externalExceptions"] = $exceptions;
    }
}
