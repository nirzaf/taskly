<?php

namespace App\Mail;

use App\Client;
use App\Project;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class ShareProjectToClient extends Mailable
{
    use Queueable, SerializesModels;
    public $client;
    public $project;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(Client $client,Project $project)
    {
        $this->client = $client;
        $this->project = $project;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->markdown('email.share')->subject('New Project Share - '.env('APP_NAME'));;
    }
}
