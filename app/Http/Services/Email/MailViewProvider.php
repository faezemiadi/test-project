<?php

namespace App\Http\Services\Email;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class MailViewProvider extends Mailable
{
    use Queueable, SerializesModels;

    public $details;
    public $from;
    public $email;
    public $attachment=[];

    
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($subject,$from,$details,$email,$attachment)
    {
        $this->from = $from;
        $this->subject = $subject;
        $this->details = $details;
        $this->email = $email;
        $this->attachment = $attachment;

    }

    public function build()
    {
        return $this->from($this->from[0]['address'], $this->from[0]['name'])
              ->to($this->email, $this->email.'-yourname')
              ->view('email.email')
              ->attachMany($this->attachment)
              ->with([
                  'details' => $this->details
              ]);
      
    }

}
