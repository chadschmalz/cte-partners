<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

use App\Models\student;

class BusinessMail extends Mailable
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
        return $this->from('mike.hassler@washk12.org')->subject('Washk12Internships - Partner Update')->markdown('emails.businessnotify');
    }

    public function setmarkdown($markdown){
        if($markdown != ''){
            $this->markdown($markdown);
            return true;
        }
        return false;
    }
}
