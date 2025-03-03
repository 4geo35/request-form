<x-tt::modal.dialog wire:model="displayForm">
    <x-slot name="title">
        Обратный звонок
    </x-slot>
    <x-slot name="content">
        <button type="button" class="btn btn-outline-dark" wire:click="closeForm">
            Отмена
        </button>
    </x-slot>
</x-tt::modal.dialog>
