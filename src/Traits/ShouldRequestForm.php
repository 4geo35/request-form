<?php

namespace GIS\RequestForm\Traits;

use GIS\RequestForm\Models\RequestForm;
use Illuminate\Database\Eloquent\Relations\MorphOne;

trait ShouldRequestForm
{
    public function form(): MorphOne
    {
        $formModelClass = config("request-form.customRequestFormModel") ?? RequestForm::class;
        return $this->morphOne($formModelClass, "recordable");
    }
}
