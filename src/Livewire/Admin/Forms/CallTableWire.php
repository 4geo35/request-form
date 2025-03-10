<?php

namespace GIS\RequestForm\Livewire\Admin\Forms;

use GIS\RequestForm\Interfaces\RequestFormModelInterface;
use GIS\RequestForm\Models\RequestForm;
use GIS\TraitsHelpers\Facades\BuilderActions;
use Illuminate\View\View;
use Livewire\Component;
use Livewire\WithPagination;

class CallTableWire extends Component
{
    use WithPagination;

    public string $searchName = "";
    public string $searchPhone = "";
    public string $searchFrom = "";
    public string $searchTo = "";
    public string $searchUri = "";
    public string $searchPlace = "";
    public string $searchIp = "";

    public bool $displayDelete = false;
    public int|null $formId = null;

    protected function queryString(): array
    {
        return [
            "searchName" => ["as" => "name", "except" => ""],
            "searchPhone" => ["as" => "phone", "except" => ""],
            "searchFrom" => ["as" => "from", "except" => ""],
            "searchTo" => ["as" => "to", "except" => ""],
            "searchUri" => ["as" => "uri", "except" => ""],
            "searchPlace" => ["as" => "place", "except" => ""],
            "searchIp" => ["as" => "ip", "except" => ""],
        ];
    }

    public function render(): View
    {
        $formModelClass = config("request-form.customRequestFormModel") ?? RequestForm::class;
        $query = $formModelClass::query();
        $query
            ->select("request_forms.*")
            ->leftJoin("call_request_records", "call_request_records.id", "=", "request_forms.recordable_id")
            ->with("recordable", "user")
            ->where("request_forms.type", "call-request");

        BuilderActions::extendLike($query, $this->searchName, "call_request_records.name");
        BuilderActions::extendLike($query, $this->searchPhone, "call_request_records.phone");
        BuilderActions::extendDate($query, $this->searchFrom, $this->searchTo, "request_forms.created_at");
        BuilderActions::extendLike($query, $this->searchUri, "request_forms.uri");
        BuilderActions::extendLike($query, $this->searchPlace, "request_forms.place");
        BuilderActions::extendLike($query, $this->searchIp, "request_forms.ip_address");

        $query->orderBy("request_forms.created_at", "DESC");
        $forms = $query->paginate();
        return view('rf::livewire.admin.forms.call-table-wire', compact("forms"));
    }

    public function clearSearch(): void
    {
        $this->reset("searchName", "searchPhone", "searchFrom", "searchTo", "searchUri", "searchPlace", "searchIp");
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
