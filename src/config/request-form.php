<?php

return [
    // Settings
    "availableForms" => [
        "call-request" => "Обратный звонок",
    ],
    "customAvailableForms" => [],

    "formItems" => [
        "call-request" => "rf::admin.forms.call-request",
    ],
    "customFormItems" => [],

    "formComponents" => [
        "call-request" => "rf-web-call-form",
    ],
    "customFormComponents" => [],

    // Admin
    "customRequestFormModel" => null,
    "customRequestFormModelObserver" => null,
    "customCallRequestRecordModel" => null,

    "customFormActionsManager" => null,

    "customFormAdminController" => null,

    // Components
    "customWebCallFormComponent" => null,
    "customAdminCallTableComponent" => null,
];
