@php
    $names = \GIS\RequestForm\Facades\FormActions::getRouteNameList();
    $list = \GIS\RequestForm\Facades\FormActions::getRouteList();
    $currentRouteName = \Illuminate\Support\Facades\Route::currentRouteName();
@endphp
<x-tt::admin-menu.item href="#" :active="in_array($currentRouteName, $names)">
    <x-slot name="ico"><x-rf::ico.forms /></x-slot>
    Формы
    <x-slot name="children">
        @foreach($list as $item)
            <x-tt::admin-menu.child href="{{ route($item->routeName) }}"
                                    :active="$item->routeName == $currentRouteName">
                {{ $item->title }}
            </x-tt::admin-menu.child>
        @endforeach
    </x-slot>
</x-tt::admin-menu.item>
