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

    protected $cascadeDeletes = [];

    public function scopeFilled($query)
    {
        return $query->where('filled', true);
    }

    public function form()
    {
        return $this->belongsTo(Form::class);
    }

    public static function templateAliasesWithOptions()
    {
        return get_form_templates()->where('attribute_type', 'array')->pluck('alias')->all();
    }
}
