<?php

namespace App\Mail;

use App\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class Welcome extends Mailable implements ShouldQueue
{
    use Queueable, SerializesModels;

    public $user;
    public $data;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(User $user)
    {
        $this->user = $user;
        $this->data = (object)[
            'product_url' => 'https://www.google.com/',
            'product_name' => 'Google Home',
            'name' => $this->user->first_name,
            'action_url' => 'https://www.google.com/',
            'login_url' => 'https://www.google.com/',
            'username' => $this->user->first_name,
            'support_email' => 'support@google.com',
            'sender_name' => 'Andry',
            'company_name' => 'Google',
            'company_address' => 'California U.S'
        ];
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this
            ->view('emails.html.welcome')
            ->text('emails.text.welcome');
    }
}
