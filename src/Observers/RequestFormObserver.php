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

    public function deleted(RequestFormModelInterface $form): void
    {
        $record = $form->recordable;
        if ($record) {
            $record->delete();
        }
    }
}
