<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class FinancialNotify extends Notification
{
    use Queueable;


    private $accountName;
    private $amount;
    private $title;
    public function __construct($accountName, $amount, $title)
    {
        $this->accountName=$accountName;
        $this->title=$title;
        $this->amount=$amount;
    }

    
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


    public function toArray($notifiable)
    {
        $formatted = number_format($this->amount);
        return [
            'title'=>'الحسابات',
            'detail'=>"المبلغ المدفوع $formatted   $this->title",
            'name'=>$this->accountName,
            'user'=>auth()->user()->name,
            
        ];
    }
}
