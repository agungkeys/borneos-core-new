<?php

namespace App\Notifications;

use App\Http\Traits\Notify;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use Illuminate\Support\Facades\Config;
use Telegram\Bot\Laravel\Facades\Telegram;

class OrderNotification extends Notification
{
    use Queueable, Notify;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['telegram'];
    }

    public function toTelegram($notifiable)
    {
        switch ($notifiable) {
            case $notifiable->status == 'new':
                $text = $this->textNotificationOrderNewTelegram($notifiable);
                Telegram::sendMessage([
                    'chat_id' => Config::get('telegram.bots.mybot.chat_id'),
                    'parse_mode' => 'HTML',
                    'text' => $text
                ]);
                break;
            case $notifiable->status == 'processing' && $notifiable->orders->count() > 0:
                $text = $this->textNotificationOrderProcessingTelegram($notifiable);
                Telegram::sendMessage([
                    'chat_id' => Config::get('telegram.bots.mybot.chat_id'),
                    'parse_mode' => 'HTML',
                    'text' => $text
                ]);
                break;
            case $notifiable->status == 'otw' && $notifiable->orders->count() > 0:
                $text = $this->textNotificationOrderOnTheWaytoTelegram($notifiable);
                Telegram::sendMessage([
                    'chat_id' => Config::get('telegram.bots.mybot.chat_id'),
                    'parse_mode' => 'HTML',
                    'text' => $text
                ]);
                break;
            default:
                return;
                break;
        }
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
                    ->line('The introduction to the notification.')
                    ->action('Notification Action', url('/'))
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
