<div class="space-y-indent-half">
    <div class="flex flex-col space-y-indent-half md:flex-row md:space-x-indent-half md:space-y-0">
        <input type="text" aria-label="Имя" placeholder="Имя" class="form-control" wire:model.live="searchName">
        <input type="text" aria-label="Телефон" placeholder="Телефон" class="form-control" wire:model.live="searchPhone">
        <div class="flex">
            <div class="form-control rounded-e-none">
                Дата:
            </div>
            <input type="date" aria-label="Дата от" class="form-control rounded-none border-x-0" wire:model.live="searchFrom">
            <input type="date" aria-label="Дата до" class="form-control rounded-s-none" wire:model.live="searchTo">
        </div>
        <button type="button" class="btn btn-outline-primary" wire:click="clearSearch">
            Очистить
        </button>
    </div>

    <div class="flex flex-col space-y-indent-half md:flex-row md:space-x-indent-half md:space-y-0">
        <input type="text" aria-label="Страница" placeholder="Страница" class="form-control" wire:model.live="searchUri">
        <input type="text" aria-label="Кнопка" placeholder="Кнопка" class="form-control" wire:model.live="searchPlace">
        <input type="text" aria-label="IP" placeholder="IP" class="form-control" wire:model.live="searchIp">
    </div>
</div>
