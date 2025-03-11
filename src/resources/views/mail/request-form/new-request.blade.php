<x-mail::message>
# Здравствуйте!

На сайте было зарегистрировано обращение "{{ $title }}"

@includeIf($template)

<x-mail::button :url="$url">
Просмотр
</x-mail::button>

С уважением,<br>
[{{ config('app.name') }}]({{ config("app.url") }})
</x-mail::message>
