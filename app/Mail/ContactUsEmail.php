<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class ContactUsEmail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    protected $firstname;
    protected $lastname;
    protected $body;
    protected $email;
    public function __construct($firstname,$lastname,$body,$email)
    {
        $this->firstname = $firstname;
        $this->lastname = $lastname;
        $this->body = $body;
        $this->email = $email;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->markdown('emails.contact.contact')->with([
            'lastname'=>$this->lastname,
            'firstname'=>$this->firstname,
            'body'=>$this->body,
            'email'=>$this->email
        ]);
    }
}
