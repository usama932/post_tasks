<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class DailyDigest extends Mailable
{
    use Queueable, SerializesModels;

    public $posts;

    public function __construct($posts)
    {
        $this->posts = $posts;
    }

    public function build()
    {
        return $this->view('emails.daily_digest')
                    ->with('posts', $this->posts);
    }
}
