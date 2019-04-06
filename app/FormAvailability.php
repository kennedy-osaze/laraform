<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class FormAvailability extends Model
{
    use SoftDeletes;

    protected $dates = ['deleted_at', 'open_form_at', 'close_form_at'];

    protected $fillable = [
        'form_id', 'open_form_at', 'close_form_at', 'response_count_limit', 'available_weekday', 'available_start_time', 'available_end_time', 'closed_form_message'
    ];

    public function form()
    {
        return $this->belongsTo(Form::class);
    }

    public static function weekDays()
    {
        return ['Sunday', 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday'];
    }
}
