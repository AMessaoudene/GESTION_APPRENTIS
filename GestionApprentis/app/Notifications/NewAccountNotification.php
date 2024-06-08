<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class NewAccountNotification extends Notification
{
    use Queueable;

    protected $compte;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($compte)
    {
        $this->compte = $compte;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param mixed $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param mixed $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        return (new MailMessage)
            ->subject('New Account Created')
            ->line('A new account has been created.')
            ->line('Name: ' . $this->compte->nom . ' ' . $this->compte->prenom)
            ->line('Email: ' . $this->compte->email)
            ->line('Thank you for using our application!');
    }
}
