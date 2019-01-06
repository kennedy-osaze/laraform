<?php

namespace App\Mail;

use App\Form;
use App\User;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class FormCollaborationMail extends Mailable implements ShouldQueue
{
    use Queueable, SerializesModels;

    public $form;

    public $user;

    public $email_message;

    public $is_user_new;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(Form $form, User $user, $email_message = '', $is_user_new = false)
    {
        $this->form = $form;
        $this->user = $user;
        $this->email_message = $email_message;
        $this->is_user_new = $is_user_new;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $subject = 'You have been invited as a Form Collaborator';
        $view = ($this->is_user_new) ? 'emails.form.collaborators.new-user' : 'emails.form.collaborators.existing-user';

        return $this->subject($subject)
            ->markdown($view);
    }
}
