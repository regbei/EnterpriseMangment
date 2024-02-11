<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class BankNotify extends Notification
{
    use Queueable;
    
    private $accountName;
    private $deposit;
    private $amount;
    private $title;
    public function __construct($accountName, $amount, $title, $deposit)
    {
        $this->accountName=$accountName;
        $this->title=$title;
        $this->deposit=$deposit;
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
            'title'=>$this->deposit,
            'detail'=>"تم إيداع المبلغ $formatted على $this->accountName",
            // 'name'=>$this->accountName,
            'user'=>auth()->user()->name,
            
        ];
    }
}
