<?php

namespace GIS\RequestForm\Livewire\Admin\Forms;

use GIS\RequestForm\Models\RequestForm;
use GIS\RequestForm\Traits\FormPageActionsTrait;
use GIS\TraitsHelpers\Facades\BuilderActions;
use Illuminate\View\View;
use Livewire\Component;
use Livewire\WithPagination;

class CallTableWire extends Component
{
    use FormPageActionsTrait;
    use WithPagination;

    public string $searchName = "";
    public string $searchPhone = "";
    public string $searchFrom = "";
    public string $searchTo = "";
    public string $searchUri = "";
    public string $searchPlace = "";
    public string $searchIp = "";

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
            "orderBy" => ["as" => "order-by", "except" => ""],
            "orderByDirection" => ["as" => "direction", "except" => ""],
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

        if ($this->orderBy === "created") {
            $orderBy = "request_forms.created_at";
        } else {
            $orderBy = "call_request_records.{$this->orderBy}";
        }
        $query->orderBy($orderBy, $this->orderByDirection);
        $forms = $query->paginate();
        return view('rf::livewire.admin.forms.call-table-wire', compact("forms"));
    }

    public function clearSearch(): void
    {
        $this->reset(
            "searchName", "searchPhone", "searchFrom", "searchTo",
            "searchUri", "searchPlace", "searchIp", "orderBy", "orderByDirection"
        );
        $this->resetPage();
    }
}
