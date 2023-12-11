<?php

namespace App\Http\Services\Message\Email;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Mail\Mailables\Attachment;

class MailViewProvider extends Mailable
{

    use Queueable, SerializesModels;

    public $details;
    protected $files;

    public function __construct($details, $subject, $from, $files = null)
    {
        $this->details = $details;
        $this->subject = $subject;
        $this->from = $from;
        $this->files = $files;
    }

    public function build()
    {
        return $this->subject($this->subject)->view('emails.send-otp');
    }

    public function attachments()
    {
        $publicFiles = [];
        if ($this->files) {
            foreach ($this->files as $file) {
                array_push($publicFiles, public_path($file));
            }
        }
        return $publicFiles;
    }
}
