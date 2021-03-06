<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use App\League;
use App\LeagueInvitation as Invitation;

class LeagueInvitation extends Mailable
{
    use Queueable, SerializesModels;

    private $league, $invitation;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(League $league, Invitation $invitation)
    {
        $this->league = $league;
        $this->invitation = $invitation;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject('Invitation to Join ' . $this->league->name)
            ->view('mail.leagueinvitation')
            ->with('league', $this->league)
            ->with('invitation', $this->invitation);
    }
}
