<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class scheduledCallForGuests extends Mailable
{
    use Queueable, SerializesModels;

    public $guest;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($guest)
    {
        $this->guest = $guest;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->from('office@nrecycli.com','Nrecycli Office Guests')
                    ->subject('Scheduled call from guests- Nrecycli Office')
                    ->markdown('emails.scheduled_call_from_guests');
    }
}
