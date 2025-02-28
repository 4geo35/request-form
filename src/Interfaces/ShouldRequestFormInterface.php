<?php

namespace GIS\RequestForm\Interfaces;

use Illuminate\Database\Eloquent\Relations\MorphOne;

interface ShouldRequestFormInterface
{
    public function form(): MorphOne;
}
