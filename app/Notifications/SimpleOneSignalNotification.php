<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Notification;
use NotificationChannels\OneSignal\OneSignalChannel;
use NotificationChannels\OneSignal\OneSignalMessage;

class SimpleOneSignalNotification extends Notification implements ShouldQueue
{
    use Queueable;

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
     * @param mixed $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return [OneSignalChannel::class];
    }

    /**
     * Get the OneSignal representation of the notification.
     *
     * @param mixed $notifiable
     * @return array
     */
    public function toOneSignal($notifiable)
    {
        return OneSignalMessage::create()
            ->setSubject([
                'en' => 'Hey, Whats up?',
                'ar' => 'Hey, Whats up?'
            ])
            ->setBody([
                'en' => 'This is a simple push notification',
                'ar' => 'This is a simple push notification'
            ]);
    }
}
