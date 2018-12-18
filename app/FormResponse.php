<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class FormResponse extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'form_id', 'form_field_id', 'answer'
    ];

    public function form()
    {
        return $this->belongsTo(Form::class);
    }

    public function formField()
    {
        return $this->belongsTo(FormField::class);
    }
}
