<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class scheduledCall extends Mailable
{
    use Queueable, SerializesModels;

    public $account;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($account)
    {
        $this->account = $account;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->from('office@nrecycli.com','Nrecycli Office')
                    ->subject('Scheduled call - Nrecycli Office')
                    ->markdown('emails.scheduled_call');
    }
}
