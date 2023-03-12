<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class SendEmail extends Mailable
{
    use Queueable, SerializesModels;

    private $kode = '';

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($kode)
    {
        //
        $this->kode = $kode;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('supports/email',['kode_otp' => $this->kode]);
    }
}
