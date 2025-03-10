<div class="space-y-1">
    <div class="flex flex-nowrap justify-start space-x-indent-half">
        <div class="font-semibold">Дата:</div>
        <div>{{ $item->created_human }}</div>
    </div>

    @if (! empty($item->uri))
        <div class="flex flex-nowrap justify-start space-x-indent-half">
            <div class="font-semibold">Страница:</div>
            <div>{{ $item->uri }}</div>
        </div>
    @endif

    @if (! empty($item->place))
        <div class="flex flex-nowrap justify-start space-x-indent-half">
            <div class="font-semibold">Кнопка:</div>
            <div>{{ $item->place }}</div>
        </div>
    @endif

    @if (! empty($item->ip_address))
        <div class="flex flex-nowrap justify-start space-x-indent-half">
            <div class="font-semibold">IP:</div>
            <div>{{ $item->ip_address }}</div>
        </div>
    @endif

    @if (! empty($item->user_id))
        <div class="flex flex-nowrap justify-start space-x-indent-half">
            <div class="font-semibold">Пользователь:</div>
            <a href="{{ route("admin.users") }}?email={{ $item->user->email }}" target="_blank"
               class="text-primary hover:text-primary-hover">
                {{ $item->user->name }}
            </a>
        </div>
    @endif
</div>
