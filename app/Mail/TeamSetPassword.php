<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class TeamSetPassword extends Mailable
{
    use Queueable, SerializesModels;

    public $user;

    public $token;

    public $employer;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($user , $token, $employer)
    {
        $this->user = $user;
        $this->token = $token;
        $this->employer = $employer;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('mail.teamSetPassword');
    }
}
