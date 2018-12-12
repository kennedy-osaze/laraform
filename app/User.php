<?php

namespace App;

use Mail;
use App\Mail\EmailVerificationMail;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\SoftDeletes;
use Iatstuti\Database\Support\CascadeSoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable, SoftDeletes, CascadeSoftDeletes;

    protected $dates = ['deleted_at'];

    protected $cascadeDeletes = [];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'first_name', 'last_name', 'email', 'password', 'email_token',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function getFullNameAttribute()
    {
        return "{$this->first_name} {$this->last_name}";
    }

    public function sendEmailVerificationNotification()
    {
        $message = new EmailVerificationMail($this);
        Mail::to($this)->send($message);
    }

    public function hasVerifiedEmail()
    {
        return is_null($this->email_token);
    }
}
