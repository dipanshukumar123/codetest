<?php

namespace App\Notifications;

use App\Channels\FutureClubChannel;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Notification;

class PhoneVerificationOTP extends Notification implements ShouldQueue
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
        return [FutureClubChannel::class];
    }

    /**
     * Get the array representation of the notification.
     *
     * @param mixed $notifiable
     * @return array
     */
    public function toFutureClub($notifiable)
    {
        return [
            'G' => $notifiable->mobile, // Mobile Numbers
            'M' => 'Dear user, Your one time password for mobile number verification is 100', // Message
            'L' => 'L', // Language
        ];
    }
}
