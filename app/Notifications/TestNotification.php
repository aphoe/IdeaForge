<?php

namespace App\Notifications;

use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class TestNotification extends Notification
{
    public function __construct()
    {
    }

    public function via($notifiable): array
    {
        return ['mail'];
    }

    public function toMail($notifiable): MailMessage
    {
        return (new MailMessage)
            ->subject('Welcome!')
            ->line('Welcome to your new account!')
            ->line('Please confirm your email address by clicking the link below.');
    }

    public function toArray($notifiable): array
    {
        return [];
    }
}
