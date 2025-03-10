### Установка

Добавить `"./vendor/4geo35/request-form/src/resources/views/components/**/*.blade.php",
        "./vendor/4geo35/request-form/src/resources/views/admin/**/*.blade.php",
        "./vendor/4geo35/request-form/src/resources/views/livewire/admin/**/*.blade.php",` в `tailwind.admin.config.js`, созданный в пакете `tailwindcss-theme`.

Добавить `"./vendor/4geo35/request-form/src/resources/views/livewire/web/**/*.blade.php",` в `tailwind.config.js`, созданный в пакете `tailwindcss-theme`.

Установить маску `npm install imask`, добавить в `app.js`:

    import IMask from "imask"
    window.IMask = IMask

Запустить миграции `php artisan migrate`
