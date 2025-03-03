<?php

namespace GIS\RequestForm\Traits;

use GIS\RequestForm\Facades\FormActions;
use Livewire\Attributes\On;

trait RequestFormShowTrait
{
    public bool $displayForm = false;

    #[On("show-request-form")]
    public function showForm(string $key): void
    {
        if (! FormActions::checkIfAvailable($key) || $key !== $this->formName) return;
        $this->resetFields();
        $this->displayForm = true;
    }

    public function closeForm(): void
    {
        $this->resetFields();
        $this->displayForm = false;
    }
}
