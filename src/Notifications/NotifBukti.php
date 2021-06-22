<?php

namespace Bageur\BuktiTransaksi\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Messages\BroadcastMessage;
use Illuminate\Notifications\Notification;

class NotifBukti extends Notification
{
    use Queueable;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($title= 'test', $message= 'test', $sender_id= '0', $type= 'Notif' , $datas = [])
    {
        $this->sender_id    = $sender_id;
        $this->title        = $title;
        $this->message      = $message;
        $this->datas        = $datas;
        $this->type        = $type;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['broadcast','database'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toBroadcast($notifiable)
    {
        return new BroadcastMessage([
            'title'     => $this->title,
            'message'   => $this->message,
        ]);
    }

    // public function toMail($notifiable)
    // {
    //     return (new MailMessage)
    //     ->subject($this->subject)
    //     ->view(
    //         'mails.general', [
    //             'notifiable' => $notifiable ,
    //             'title' => $this->title,
    //             'text' => $this->message,
    //         ]
    //     );
    // }

    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toDatabase($notifiable)
    {
         return [
            'id'        => $this->id,
            'sender_id' => $this->sender_id,
            'title'     => $this->title,
            'message'   => $this->message,
            'datas'     => $this->datas,
            'type'     => $this->type,
        ];
    }
}
