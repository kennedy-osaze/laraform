<?php

namespace App\Mail;

use App\Form;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class ShareFormLinkMail extends Mailable implements ShouldQueue
{
    use Queueable, SerializesModels;

    public $form;

    public $data;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(Form $form, array $data = [])
    {
        $this->form = $form;
        $this->data = $data;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject($this->data['email_subject'])
            ->markdown('emails.form.share');
    }
}
