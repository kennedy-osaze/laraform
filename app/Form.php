<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Iatstuti\Database\Support\CascadeSoftDeletes;

class Form extends Model
{
    use SoftDeletes, CascadeSoftDeletes;

    const STATUS_DRAFT = 'draft';
    const STATUS_PENDING = 'pending';
    const STATUS_OPEN = 'open';
    const STATUS_CLOSED = 'closed';

    protected $dates = ['deleted_at'];

    protected $cascadeDeletes = ['fields'];

    protected $fillable = [
        'user_id', 'title', 'description', 'code', 'status',
    ];

    public function getRouteKeyName()
    {
        return 'code';
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function fields()
    {
        return $this->hasMany(FormField::class);
    }

    public function generateCode()
    {
        do {
            $this->code = str_random(32);
        } while (static::where('code', $this->code)->exists());
    }

    public static function getStatusSymbols()
    {
        return [
            static::STATUS_DRAFT => ['label' => 'Draft', 'color' => 'slate'],
            static::STATUS_PENDING => ['label' => 'Ready to Open', 'color' => 'primary'],
            static::STATUS_OPEN => ['label' => 'Open', 'color' => 'success'],
            static::STATUS_CLOSED => ['label' => 'Closed', 'color' => 'pink'],
        ];
    }
}
