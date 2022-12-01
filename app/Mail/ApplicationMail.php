<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

use App\Models\student;

class ApplicationMail extends Mailable
{
    use Queueable, SerializesModels;

    public $student;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(student $student)
    {

        $this->student = $student;

    }


    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->from('washk12internships@washk12.org')->subject('Internship Application (Response Required)')->markdown('emails.applicationaccepted');
    }

    public function setmarkdown($markdown){
        if($markdown != ''){
            $this->markdown($markdown);
            return true;
        }
        return false;
    }
}
