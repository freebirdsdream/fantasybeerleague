<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class LeagueMessage extends Mailable
{
    use Queueable, SerializesModels;

    private $league, $message, $user, $rules;
    public $subject;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($league, $subject, $message, $user, $rules = false)
    {
        $this->league = $league;
        $this->subject = $subject;
        $this->message = $message;
        $this->user = $user;
        $this->rules = $rules;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject($this->subject)
            ->view('mail.leaguemessage')
            ->with('league', $this->league)
            ->with('text', $this->message)
            ->with('rules', $this->rules)
            ->with('user', $this->user);
    }
}
