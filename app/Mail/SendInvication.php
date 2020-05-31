<?php

namespace App\Mail;

use App\Project;
use App\User;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class SendInvication extends Mailable
{
    use Queueable, SerializesModels;

    public $user;
    public $project;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(User $user,Project $project)
    {
        $this->user = $user;
        $this->project = $project;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->markdown('email.invitation')->subject('New Project Invitation - '.env('APP_NAME'));
    }
}
