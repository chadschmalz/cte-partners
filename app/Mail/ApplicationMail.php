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
    public $markdown = 'emails.applicationaccepted';

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(student $student, $markdown)
    {

        $this->student = $student;
        $this->markdown = $markdown;

    }


    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->from('washk12internships@washk12.org')->subject('Internship Application (Response Required)')->markdown($this->markdown);
    }

    public function setmarkdown($markdown){
        if($markdown != ''){
            $this->markdown($markdown);
            return true;
        }
        return false;
    }
}
