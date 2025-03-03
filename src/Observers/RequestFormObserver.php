<?php

namespace GIS\RequestForm\Observers;

use GIS\RequestForm\Interfaces\RequestFormModelInterface;
use Illuminate\Support\Facades\Auth;

class RequestFormObserver
{
    public function creating(RequestFormModelInterface $form): void
    {
        $form->ip_address = request()->ip();
        if (Auth::check()) {
            $form->user_id = Auth::id();
        }
    }
}
