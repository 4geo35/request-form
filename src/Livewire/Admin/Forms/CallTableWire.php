<?php

namespace GIS\RequestForm\Livewire\Admin\Forms;

use GIS\RequestForm\Interfaces\RequestFormModelInterface;
use GIS\RequestForm\Models\RequestForm;
use Illuminate\View\View;
use Livewire\Component;
use Livewire\WithPagination;

class CallTableWire extends Component
{
    use WithPagination;

    public string $searchName = "";
    public string $searchPhone = "";

    public bool $displayDelete = false;
    public int|null $formId = null;

    protected function queryString(): array
    {
        return [
            "searchName" => ["as" => "name", "except" => ""],
            "searchPhone" => ["as" => "phone", "except" => ""],
        ];
    }

    public function render(): View
    {
        $formModelClass = config("request-form.customRequestFormModel") ?? RequestForm::class;
        $query = $formModelClass::query();
        $query->with("recordable");
        $query->where("type", "call-request");

        $query->orderBy("created_at", "DESC");
        $forms = $query->paginate();
        return view('rf::livewire.admin.forms.call-table-wire', compact("forms"));
    }

    public function clearSearch(): void
    {
        $this->reset("searchName", "searchPhone");
        $this->resetPage();
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
