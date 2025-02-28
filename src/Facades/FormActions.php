<?php

namespace GIS\RequestForm\Facades;

use GIS\RequestForm\Helpers\FormActionsManager;
use Illuminate\Support\Facades\Facade;

/**
 * @method static array getRouteList()
 * @method static array getRouteNameList()
 *
 * @see FormActionsManager
 */
class FormActions extends Facade
{
    protected static function getFacadeAccessor(): string
    {
        return "form-actions";
    }
}
