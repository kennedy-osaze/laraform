<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Iatstuti\Database\Support\CascadeSoftDeletes;

class FormField extends Model
{
    use SoftDeletes, CascadeSoftDeletes;

    protected $fillable = [
        'form_id', 'template', 'question', 'required', 'options', 'attribute', 'filled'
    ];

    protected $casts = [
        'required' => 'boolean',
        'filled' => 'boolean',
        'options' => 'array',
    ];

    protected $cascadeDeletes = ['responses'];

    public function scopeFilled($query)
    {
        return $query->where('filled', true);
    }

    public function form()
    {
        return $this->belongsTo(Form::class);
    }

    public function responses()
    {
        return $this->hasMany(FieldResponse::class);
    }

    public function getResponseSummaryDataForChart()
    {
        $responses = $this->responses;

        if ($responses->isEmpty()) {
            return [];
        }

        $use_chart = '';
        $data = [];

        switch ($this->template) {
            case 'drop-down':
            case 'multiple-choices':
            case 'checkboxes':
                $use_chart = ($this->template == 'checkboxes') ? 'h_bar_chart' : 'pie_chart';

                $data[] = ($this->template == 'drop-down')
                    ? ['Option', 'No. of option selected']
                    : ['Choice', 'No. of choice selected'];

                foreach ($this->options as $option) {
                    if ($this->template == 'checkboxes') {
                        $option_selected_count = $responses->filter(function ($v, $k) use ($option) {
                            $value = (array) json_decode($v->answer);
                            return in_array($option, $value);
                        })->count();
                    } else {
                        $option_selected_count = $responses->where('answer', $option)->count();
                    }

                    array_push($data, [$option, $option_selected_count]);
                }

                break;

            case 'linear-scale':
                $use_chart = 'v_bar_chart';
                $min = $this->options['min'];
                $max = $this->options['max'];

                $data[] = ['Scale value', 'Count'];

                foreach (range((int) $min['value'], (int) $max['value']) as $value) {
                    $value_selected_counts = $responses->where('answer', $value)->count();

                    array_push($data, [$value, $value_selected_counts]);
                }

                break;
        }

        return [
            'chart' => $use_chart,
            'name' => str_replace('.', '_', $this->attribute),
            'data' => $data
        ];
    }
}
