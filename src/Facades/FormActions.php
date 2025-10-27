<?php

namespace GIS\RequestForm\Facades;

use GIS\RequestForm\Helpers\FormActionsManager;
use Illuminate\Support\Facades\Facade;

/**
 * @method static array prepareValidation(array $data)
 *
 * @method static array getFormList()
 * @method static string getTitleByKey(string $key)
 * @method static string getRowsTemplateByKey(string $key)
 * @method static string getComponentByKey(string $key)
 *
 * @method static array getRouteList()
 * @method static array getRouteNameList()
 * @method static bool checkIfAvailable(string $key)
 * @method static string getAdminViewByKey(string $key)
 *
 * @method static bool checkIfMenuIsActive()
 * @method static bool checkIfMenuItemIsActive(string $key)
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
