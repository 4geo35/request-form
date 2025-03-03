<?php

namespace GIS\RequestForm\Livewire\Web\Forms;

use GIS\RequestForm\Interfaces\RequestFormShowInterface;
use GIS\RequestForm\Traits\RequestFormShowTrait;
use Illuminate\Support\Facades\Route;
use Illuminate\View\View;
use Livewire\Component;

class WebCallFormWire extends Component implements RequestFormShowInterface
{
    use RequestFormShowTrait;
    public string $formName = "call-request";
    public bool $modal = false;
    public string $postfix = "";

    public string $name = "";
    public string $phone = "";
    public bool $privacy = true;

    public string $prefix = "";

    public function mount(): void
    {
        $array = [$this->formName];
        if ($this->modal) $array[] = "modal";
        if ($this->postfix) $array[] = $this->postfix;
        $this->prefix = implode("-", $array);
        $this->prefix .= "-";
    }

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
        session()->flash("{$this->prefix}success", "Ваше обращение получено! Мы свяжемся с вами в ближайшее время.");
        $this->resetFields();
    }

    public function resetFields(): void
    {
        $this->reset("name", "phone");
    }
}
