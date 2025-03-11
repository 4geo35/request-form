<?php

namespace GIS\RequestForm\Observers;

use GIS\RequestForm\Interfaces\RequestFormModelInterface;
use GIS\RequestForm\Notifications\NewFormRequest;
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

    public function created(RequestFormModelInterface $form): void
    {
        $notificationClass = config("request-form.customRequestFormModelNotification") ?? NewFormRequest::class;
        $form->notify(new $notificationClass);
    }

    public function deleted(RequestFormModelInterface $form): void
    {
        $record = $form->recordable;
        if ($record) {
            $record->delete();
        }
    }
}
