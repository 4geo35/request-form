@php
    $isActive = \GIS\RequestForm\Facades\FormActions::checkIfMenuIsActive();
    $list = \GIS\RequestForm\Facades\FormActions::getRouteList();
@endphp
<x-tt::admin-menu.item href="#" :active="$isActive">
    <x-slot name="ico"><x-rf::ico.forms /></x-slot>
    Формы
    <x-slot name="children">
        @foreach($list as $item)
            @php($itemIsActive = \GIS\RequestForm\Facades\FormActions::checkIfMenuItemIsActive($item->key))
            <x-tt::admin-menu.child href="{{ route($item->routeName, $item->key) }}"
                                    :active="$itemIsActive">
                {{ $item->title }}
            </x-tt::admin-menu.child>
        @endforeach
    </x-slot>
</x-tt::admin-menu.item>
