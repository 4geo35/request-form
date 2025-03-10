<?php

namespace GIS\RequestForm\Traits;

use GIS\RequestForm\Interfaces\RequestFormModelInterface;
use GIS\RequestForm\Models\RequestForm;

trait FormPageActionsTrait
{
    public string $orderBy = "created";
    public string $orderByDirection = "desc";

    public bool $displayDelete = false;
    public int|null $formId = null;

    public function changeOrder(string $orderBy): void
    {
        if ($this->orderBy === $orderBy) {
            $this->orderByDirection = $this->orderByDirection == "desc" ? "asc" : "desc";
        } else {
            $this->orderBy = $orderBy;
            $this->orderByDirection = "desc";
        }
    }

    public function showDelete(int $formId): void
    {
        $this->resetFields();
        $this->formId = $formId;
        $form = $this->findForm();
        if (! $form) return;

        $this->displayDelete = true;
    }

    public function confirmDelete(): void
    {
        $form = $this->findForm();
        if (! $form) return;

        try {
            $form->delete();
            session()->flash("success", "Заявка успешно удалена");
        } catch (\Exception $exception) {
            session()->flash("error", "Ошибка во время удаления заявки");
        }

        $this->closeDelete();
        $this->resetPage();
    }

    public function closeDelete(): void
    {
        $this->displayDelete = false;
        $this->resetFields();
    }

    protected function resetFields(): void
    {
        $this->reset("formId");
    }

    protected function findForm(): ?RequestFormModelInterface
    {
        $formModelClass = config("request-form.customRequestFormModel") ?? RequestForm::class;
        $form = $formModelClass::query()->find($this->formId);
        if (!$form) {
            session()->flash("error", "Заявка не найдена");
            $this->closeDelete();
            return null;
        }
        return $form;
    }
}
