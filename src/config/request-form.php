<?php

return [
    // Settings
    // Доступные типы формы
    "availableForms" => [
        "call-request" => [
            "title" => "Обратный звонок",
            // Шаблон для вывода полей формы
            "notificationRow" => "rf::mail.rows.call-request",
            // Livewire компонент для вывода формы
            "component" => "rf-web-call-form",
            // Страница в админке
            "admin" => "rf::admin.forms.call-request",
        ]
    ],
    "customAvailableForms" => [],
    "externalExceptions" => [],

    // Список email на отправку
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
