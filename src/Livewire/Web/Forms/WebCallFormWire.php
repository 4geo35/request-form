<?php

namespace GIS\RequestForm\Livewire\Web\Forms;

use GIS\RequestForm\Interfaces\RequestFormShowInterface;
use GIS\RequestForm\Models\CallRequestRecord;
use GIS\RequestForm\Traits\RequestFormActionsTrait;
use Illuminate\View\View;
use Livewire\Component;

class WebCallFormWire extends Component implements RequestFormShowInterface
{
    use RequestFormActionsTrait;
    public string $formName = "call-request";
    public bool $modal = false;
    public string $postfix = "";
    public string $double = "";

    public string $name = "";
    public string $phone = "";
    public bool $privacy = false;

    public string $prefix = "";

    public function rules(): array
    {
        return [
            "name" => ["required", "string", "max:50"],
            "phone" => ["required", "string", "max:18", "min:18"],
            "privacy" => ["required"],
        ];
    }

    public function validationAttributes(): array
    {
        return [
            "name" => "Имя",
            "phone" => "Номер телефона",
            "privacy" => "Политика конфиденциальности",
        ];
    }

    public function render(): View
    {
        return view('rf::livewire.web.forms.web-call-form-wire');
    }

    public function store(): void
    {
        $this->validate();
        try {
            $callRequestModelClass = config("request-form.customCallRequestRecordModel") ?? CallRequestRecord::class;
            $record = $callRequestModelClass::create([
                "name" => $this->name,
                "phone" => $this->phone,
            ]);
            $form = $this->createForm($record);
            if (! $form) {
                $record->delete();
                session()->flash("{$this->prefix}error", "Ошибка при сохранении данных.");
            } else {
                session()->flash("{$this->prefix}success", "Ваше обращение получено! Мы свяжемся с вами в ближайшее время.");
            }
        } catch (\Exception $exception) {
            session()->flash("{$this->prefix}error", "Ошибка при сохранении данных.");
        }

        $this->resetFields();
    }

    public function resetFields(): void
    {
        $this->reset("name", "phone", "privacy");
    }
}
