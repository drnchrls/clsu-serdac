<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class SubmissionPublicationRejectNotification extends Notification
{
    use Queueable;

    public $level;
    public $message;
    public $name;
    public $subject;
    public $remarks;
    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($level, $message, $name, $subject, $remarks)
    {
        //
        $this->level = $level;
        $this->message = $message;
        $this->name = $name;
        $this->subject = $subject;
        $this->remarks = $remarks;
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
                    ->level($this->level)
                    ->subject($this->subject)
                    ->greeting('Hi '.$this->name.',')
                    ->line($this->message)
                    ->line('Remarks: '.$this->remarks)
                    ->line('Thank you for using our application!');
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
