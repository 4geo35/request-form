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

    "formNotificationEmails" => env("REQUEST_FORM_NOTIFICATION_EMAILS"),

    // Admin
    "customRequestFormModel" => null,
    "customRequestFormModelObserver" => null,
    "customRequestFormModelNotification" => null,

    "customCallRequestRecordModel" => null,

    "customFormActionsManager" => null,

    "customFormAdminController" => null,

    // Components
    "customWebCallFormComponent" => null,
    "customAdminCallTableComponent" => null,
];
