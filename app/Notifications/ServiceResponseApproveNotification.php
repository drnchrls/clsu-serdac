<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class ServiceResponseApproveNotification extends Notification
{
    use Queueable;
    public $subject;
    public $req;
    public $specific_req;
    public $name;
    public $type;
    public $linkPlace;
    public $time;
    public $remark;
    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($subject, $req, $specific_req, $name, $type, $linkPlace, $time, $remark)
    {
        //
        $this->subject = $subject;
        $this->req = $req;
        $this->specific_req = $specific_req;
        $this->name = $name;
        $this->type = $type;
        $this->linkPlace = $linkPlace;
        $this->time = $time;
        $this->remark = $remark;
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
                    ->subject($this->subject)  
                    ->greeting('Good day! '.$this->name.',')
                    ->line('Your request of '.$this->req.' for '.$this->specific_req.' has been approved.')
                    ->line('Meeting Type: '.$this->type)
                    ->line('Meeting Time: '.date('l, M d, Y, h:i a', strtotime($this->time)))
                    ->line('Meeting Location/Link: '.$this->linkPlace)
                    ->line('Remarks: '.$this->remark)
                    ->line('Thank you for acquiring on our services!');
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
