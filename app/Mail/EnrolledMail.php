<?php

namespace App\Mail;

use App\Models\Enroll;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class EnrolledMail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */

    public $enroll;
    public function __construct(Enroll $enroll)
    {
        $this->enroll = $enroll;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->from('noreply@nexus.com')
            ->subject('Nexus application submitted')
        ->markdown('emails.enrolled');
    }
}
