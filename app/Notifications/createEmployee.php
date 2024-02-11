<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class createEmployee extends Notification
{
    use Queueable;

    public $employee_id;
    public $fullName;
    public function __construct($employee_id,$fullName)
    {
        $this->employee_id=$employee_id;
        $this->fullName=$fullName;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['database'];
    }

    // public function toMail($notifiable)
    // {
    //     return (new MailMessage)
    //                 ->line('The introduction to the notification.')
    //                 ->action('Notification Action', url('/'))
    //                 ->line('Thank you for using our application!');
    // }

    public function toDatabase($notifiable)
    {
        return [
            'title'=>'الموارد البشرية',
            'name'=>$this->fullName,
            'detail'=>'تم تعيين موظف جديد',
            'user'=>auth()->user()->name,
        ];
    }
}
