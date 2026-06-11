<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class MailtrapVerifyEmail extends Notification
{
    use Queueable;

    public string $token;

    /**
     * Create a new notxification instance.
     */
    public function __construct(string $token)
    {
        $this->token = $token;
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

    /**
     * Get the mail representation of the notification.
     */
    public function toMail(object $notifiable): MailMessage
    {
        $url = route('forgot-password.reset-form', [
            'token' => $this->token,
            'email' => $notifiable->getEmailForPasswordReset()
        ]);

        return (new MailMessage)
            ->subject('Atur Ulang Kata Sandi Anda')
            ->view('emails.verify-email', [
                'url' => $url,
                'name' => $notifiable->name
            ]);
    }
}
