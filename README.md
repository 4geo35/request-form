### Установка

Добавить `"./vendor/4geo35/request-form/src/resources/views/components/**/*.blade.php",
        "./vendor/4geo35/request-form/src/resources/views/admin/**/*.blade.php",
        "./vendor/4geo35/request-form/src/resources/views/livewire/admin/**/*.blade.php",` в `tailwind.admin.config.js`, созданный в пакете `tailwindcss-theme`.

Добавить `"./vendor/4geo35/request-form/src/resources/views/livewire/web/**/*.blade.php",` в `tailwind.config.js`, созданный в пакете `tailwindcss-theme`.

Установить маску `npm install imask`, добавить в `app.js`:

    import IMask from "imask"
    window.IMask = IMask

Запустить миграции `php artisan migrate`

Задать в `.env` параметр `REQUEST_FORM_NOTIFICATION_EMAILS`, через запятую перечислить email адреса для отправки форм


### Вывод формы

Для вывода формы на страницу:

    <livewire:rf-web-call-form :modal="true" />

Если нужно вывести кнопку для вызова модального окна с формой, при выводе параметр `place` сохраниться в форме:

    <button type="button" class="btn btn-primary" x-data
            @click="$dispatch('show-request-form', { key: 'call-request', place: 'Кнопка' })">
        Заказать обратный звонок
    </button>

    <livewire:rf-web-call-form :modal="true" />

Если на странице несколько форм, у компонента есть параметр `postfix` с его помощью можно задать уникальные id для полей формы. Параметр `prefix` задаст уникальные значения для сообщений от формы (что бы сообщения не выводились сразу во всех формах)
