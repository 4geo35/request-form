<?php

namespace GIS\RequestForm\Livewire\Web\Forms;

use GIS\RequestForm\Interfaces\RequestFormShowInterface;
use GIS\RequestForm\Traits\RequestFormShowTrait;
use Illuminate\View\View;
use Livewire\Component;

class WebCallFormWire extends Component implements RequestFormShowInterface
{
    use RequestFormShowTrait;
    protected string $formName = "call-form";

    public function render(): View
    {
        return view('rf::livewire.web.forms.web-call-form-wire');
    }

    public function resetFields(): void
    {

    }
}
