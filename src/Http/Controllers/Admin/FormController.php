<?php

namespace GIS\RequestForm\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use GIS\RequestForm\Facades\FormActions;
use Illuminate\View\View;

class FormController extends Controller
{
    public function show(string $key): View
    {
        if (! FormActions::checkIfAvailable($key)) abort(404);
        return view(FormActions::getAdminViewByKey($key), compact('key'));
    }
}
