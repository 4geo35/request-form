<?php

return [
    // Settings
    // Доступные типы формы
    "availableForms" => [
        "call-request" => "Обратный звонок",
    ],
    "customAvailableForms" => [],
    // Страница в админке
    "formItems" => [
        "call-request" => "rf::admin.forms.call-request",
    ],
    "customFormItems" => [],
    // Шаблон для вывода полей формы
    "notificationRows" => [
        "call-request" => "rf::mail.rows.call-request",
    ],
    "customNotificationRows" => [],
    // Livewire компонент для вывода формы
    "formComponents" => [
        "call-request" => "rf-web-call-form",
    ],
    "customFormComponents" => [],
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
