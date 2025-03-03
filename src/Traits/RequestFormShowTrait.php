<?php

namespace GIS\RequestForm\Traits;

use GIS\RequestForm\Facades\FormActions;
use Livewire\Attributes\On;

trait RequestFormShowTrait
{
    public bool $displayForm = false;
    public string $uri = "";
    public string $place = "";

    #[On("show-request-form")]
    public function showForm(string $key, string $place = null): void
    {
        if (! FormActions::checkIfAvailable($key) || $key !== $this->formName) { return; }
        if ($place) { $this->place = $place; }
        $this->resetFields();
        $this->displayForm = true;
    }

    public function closeForm(): void
    {
        $this->resetFields();
        $this->displayForm = false;
    }
}
