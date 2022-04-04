<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class SendMailable extends Mailable
{
    use Queueable, SerializesModels;
    public $name;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($data=[])
    {
        $this->data = $data;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {

        $job_title = $this->data['job_title'];
        $app_name = $this->data['name'];
        $app_email = $this->data['email'];

        // https://www.youtube.com/watch?v=HTP12jWV-Yw
        return $this->subject('New application for ' . $job_title)
                    ->view('emails.TestMail')
                    ->with([
                        'job_title' => $job_title,
                        'app_name' => $app_name,
                        'app_email' => $app_email,
                    ])
                    ->attach($this->data['resume_path'],
                    [
                        'as' => $this->data['resume_name'],
                        'mime' => $this->data['resume_mime'],
                    ]);
        ;
    }
}