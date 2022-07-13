<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class TestEmail extends Mailable
{
    use Queueable, SerializesModels;

    public $mailData;
    public $mailTitle;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($mailData, $mailTitle)
    {
        $this->mailData = $mailData;
        $this->mailTitle = $mailTitle;        
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()    
    {       
        $title=$this->mailTitle;
        return $this->subject($title)->view('email')->with('mailData');

    }
}
