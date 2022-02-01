<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class Forfais extends Mailable
{
    use Queueable, SerializesModels;

    public $invoice;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($forfais)
    {
        $this->forfais = $forfais;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->from('office@nrecycli.com','Nrecycli Office')
                    ->subject('Devis - Nrecycli Office ')
                    ->attach(storage_path().'/Forfais Office.pdf')
                    ->markdown('emails.forfais');       
    }
}
