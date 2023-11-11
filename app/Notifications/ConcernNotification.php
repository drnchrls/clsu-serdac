<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class ConcernNotification extends Notification
{
    use Queueable;
    public $email;
    public $name;
    public $phone;
    public $concern;
    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($email, $name, $phone, $concern)
    {
        //
        $this->email = $email;
        $this->name = $name;
        $this->phone = $phone;
        $this->concern = $concern;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        return (new MailMessage)
                    ->from($address = $this->email, $name = $this->name)
                    ->subject('Concern Notification')
                    ->greeting('Hi, Admin!')
                    ->line('There is a concern submitted through our website.')
                    ->line('Details:')
                    ->line('Email: '.$this->email)
                    ->line('Phone: '.$this->phone)
                    ->line('Concern: '.$this->concern);
                    // ->line('Thank you for using our application!');
    }

    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        return [
            //
        ];
    }
}
