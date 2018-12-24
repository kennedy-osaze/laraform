<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Iatstuti\Database\Support\CascadeSoftDeletes;

class FormResponse extends Model
{
    use SoftDeletes, CascadeSoftDeletes;

    protected $fillable = [
        'form_id', 'response_code', 'respondent_ip', 'respondent_user_agent'
    ];

    protected $cascadeDeletes = ['fieldResponses'];

    public function form()
    {
        return $this->belongsTo(Form::class);
    }

    public function fieldResponses()
    {
        return $this->hasMany(FieldResponse::class);
    }

    public function generateResponseCode()
    {
        do {
            $this->response_code = str_random(64);
        } while (static::where('response_code', $this->response_code)->exists());
    }

    public function getQuestionAnswerMap()
    {
        $this->loadMissing('fieldResponses.formField');

        $map = [];

        foreach ($this->fieldResponses as $response) {
            $field = $response->formField;
            $data = [];

            if (!$field) {
                continue;
            }

            $data = [
                'question' => $field->question,
                'answer' => $response->getAnswerForTemplate($field->template),
                'required' => $field->required,
                'template' => $field->template,
                'options' => $field->options,
            ];

            array_push($map, $data);
        }

        return $map;
    }
}
