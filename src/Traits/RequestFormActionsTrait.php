<?php

namespace GIS\RequestForm\Traits;

use GIS\RequestForm\Facades\FormActions;
use GIS\RequestForm\Interfaces\RequestFormModelInterface;
use GIS\RequestForm\Interfaces\ShouldRequestFormInterface;
use GIS\RequestForm\Models\RequestForm;
use Livewire\Attributes\On;

trait RequestFormActionsTrait
{
    public bool $displayForm = false;
    public string $uri = "";
    public string $place = "";

    #[On("show-request-form")]
    public function showForm(string $key, string $place = null): void
    {
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
