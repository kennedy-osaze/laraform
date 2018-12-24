<?php

namespace App;

use Moment;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class FieldResponse extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'form_field_id', 'form_response_id', 'answer',
    ];

    public function formField()
    {
        return $this->belongsTo(FormField::class);
    }

    public function getAnswerForTemplate($template)
    {
        switch ($template) {
            case 'long-answer':
                return str_convert_line_breaks($this->answer);
            case 'checkboxes':
                return e(implode(', ', json_decode($this->answer)));
            case 'linear-scale':
                return e($this->answer);
            case 'date':
            case 'time':
                $format = ($template === 'date') ? 'jS F, Y' : 'g:i a';
                return e(Moment::parse($this->answer)->format($format));
            default:
                return clean($this->answer);
        }
    }
}
