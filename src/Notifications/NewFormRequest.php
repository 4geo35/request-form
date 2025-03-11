<?php

namespace GIS\RequestForm\Notifications;

use GIS\RequestForm\Facades\FormActions;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class NewFormRequest extends Notification implements ShouldQueue
{
    use Queueable;

    /**
     * Create a new notification instance.
     */
    public function __construct()
    {
        //
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        return ['mail'];
    }

    public function toMail(object $notifiable): MailMessage
    {
        $notifiable->load("recordable");

        return (new MailMessage)
            ->subject('Зарегистрировано новое обращение на сайте')
            ->markdown("rf::mail.request-form.new-request", [
                "form" => $notifiable,
                "title" => FormActions::getTitleByKey($notifiable->type),
                "url" => route("admin.forms.show", $notifiable->type) . "?id={$notifiable->id}",
                "template" => FormActions::getRowsTemplateByKey($notifiable->type),
            ]);
    }
}
