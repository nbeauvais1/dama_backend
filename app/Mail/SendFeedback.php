<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class SendFeedback extends Mailable
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
        $hearAbout = $this->data['hearAbout'];
        $prep = $this->data['prep'];
        $topics = $this->data['topics'];
        $courseName = $this->data['course_name'];
        $course_id = $this->data['course_id'];
        $courseDate = $this->data['course_date'];
        $quality = $this->data['quality'];
        $courseContent = $this->data['course_content'];
        $fname = $this->data['fname'];
        $lname = $this->data['lname'];
        $email = $this->data['email'];

        // https://www.youtube.com/watch?v=HTP12jWV-Yw
        return $this->subject('New Feedback For ' . $courseName)
                    ->view('emails.SendFeedback')
                    ->with([
                        'hearAbout' => $hearAbout,
                        'prep' => $prep,
                        'topics' => $topics,
                        'course_name' => $courseName,
                        'course_id' => $course_id,
                        'course_date' => $courseDate,
                        'quality' => $quality,
                        'course_content' => $courseContent,
                        'fname' => $fname,
                        'lname' => $lname,
                        'email' => $email,
                    ]);
    }
}