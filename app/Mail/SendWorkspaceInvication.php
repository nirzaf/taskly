<?php

namespace App\Mail;

use App\User;
use App\Workspace;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class SendWorkspaceInvication extends Mailable
{
    use Queueable, SerializesModels;

    public $user;
    public $workspace;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(User $user,Workspace $workspace)
    {
        $this->user = $user;
        $this->workspace = $workspace;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->markdown('email.workspace_invitation')->subject('New Workspace Invitation - '.env('APP_NAME'));
    }
}
