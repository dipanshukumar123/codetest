<?php

namespace App\Channels;

use Exception;
use GuzzleHttp\Client as GuzzleHttp;
use Illuminate\Notifications\Notification;

class FutureClubChannel
{
    /**
     * Send the given notification.
     *
     * @param mixed $notifiable
     * @param \Illuminate\Notifications\Notification $notification
     * @return void
     * @throws Exception
     */
    public function send($notifiable, Notification $notification)
    {
        $message = $notification->toFutureClub($notifiable);

        $client = new GuzzleHttp();

        $response = $client->request('GET', 'http://62.215.226.164/fccsms.aspx', [
            'debug' => false,
            'query' => [
                'UID' => config('services.futureclub.username'),
                'p' => config('services.futureclub.password'),
                'S' => config('services.futureclub.sender_id'),
                'G' => $message['G'],
                'M' => $message['M'],
                'L' => $message['L'],
            ]
        ]);

        $code = substr($response->getBody(), 0, 2);

        if (strval($code) != '00') {
            throw new Exception($response->getBody());
        }
    }
}
