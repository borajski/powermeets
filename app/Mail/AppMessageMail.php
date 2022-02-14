<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class AppMessageMail extends Mailable
{
    use Queueable, SerializesModels;
    public $feedback;
    public $adresa;
    public $nominacija;
    

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($feedback,$adresa,$nominacija)
    {
        $this->feedback = $feedback;
        $this->adresa = $adresa;
        $this->nominacija = $nominacija;
        
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
      return $this->from($this->adresa,'PowerMeets')->subject('Entry Form')->view('emails.email')->with('nominacija',$this->nominacija);
   
    
    }
}
