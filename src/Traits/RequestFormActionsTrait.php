<?php

namespace GIS\RequestForm\Traits;

use GIS\RequestForm\Facades\FormActions;
use GIS\RequestForm\Interfaces\RequestFormModelInterface;
use GIS\RequestForm\Interfaces\ShouldRequestFormInterface;
use Livewire\Attributes\On;

trait RequestFormActionsTrait
{
    public bool $displayForm = false;
    public string $uri = "";
    public string $place = "";

    public function mount(): void
    {
        $array = [$this->formName];
        if ($this->modal) $array[] = "modal";
        $this->prefix .= implode("-", $array);
        $this->prefix .= "-";

        $this->uri = url()->current();
    }

    #[On("show-request-form")]
    public function showForm(string $key, string $place = null, string $double = null): void
    {
        if (! $this->modal) { return; }
        if (! empty($double) && $double !== $this->double) { return; }
        if (! FormActions::checkIfAvailable($key) || $key !== $this->formName) { return; }
        if ($place) { $this->place = $place; }
        else { $this->reset("place"); }
        $this->resetFields();
        $this->displayForm = true;
    }

    public function closeForm(): void
    {
        $this->resetFields();
        $this->displayForm = false;
    }

    protected function createForm(ShouldRequestFormInterface $record): ?RequestFormModelInterface
    {
        try {
            return $record->form()->create([
                "type" => $this->formName,
                "place" => $this->place,
                "uri" => $this->uri,
            ]);
        } catch (\Exception $exception) {
            return null;
        }
    }
}
