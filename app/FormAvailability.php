<?php

namespace App;

use DB;
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

    public function scopeWhereFormReadyForOpen($query)
    {
        return $query->whereHas('form', function ($query) {
            $query->whereIn('status', [Form::STATUS_PENDING, Form::STATUS_CLOSED]);
        });
    }

    public function scopeWhereFormReadyForClose($query)
    {
        return $query->whereHas('form', function ($query) {
            $query->where('status', Form::STATUS_OPEN);
        });
    }

    public function scopeWhereAvailabilityBetweenStartAndEnd($query)
    {
        return $query->where(function ($query) {
            $query->whereAvailabilityBegins()
                ->where(function ($q) {
                    $q->whereAvailabilityEnds()
                        ->orWhere(function ($q) {
                            $q->whereFormResponseComparesToLimit('<');
                        });
                });
        });
    }

    public function scopeWhereAvailabilityBegins($query)
    {
        return $query->where(function ($q) {
            $q->whereNotNull('open_form_at')
                ->whereRaw('open_form_at <= timestamp(?)', [now()->toDateTimeString()]);
        });
    }

    public function scopeWhereAvailabilityEnds($query)
    {
        return $query->where(function ($q) {
            $q->whereNotNull('close_form_at')
                ->whereRaw('close_form_at > timestamp(?)', [now()->toDateTimeString()]);
        });
    }

    public function scopeWhereFormResponseComparesToLimit($query, $operator = '=')
    {
        if (in_array($operator, ['>', '>=', '=', '!=', '<', '<='])) {
            return
                $query->whereNotNull('response_count_limit')
                    ->whereExists(function ($q) use ($operator) {
                    $q->select(DB::raw(1))
                        ->from('forms')
                        ->whereNull('deleted_at')
                        ->whereRaw('form_availabilities.form_id = forms.id')
                        ->whereRaw("(select count(*) from form_responses where forms.id = form_responses.form_id and form_responses.deleted_at is null group by form_id) {$operator} form_availabilities.response_count_limit");
                });
        }

        return $query;
    }

    public function scopeWhereAvailabilityOpensWithinSpecifiedPeriod($query)
    {
        return $query->where(function ($q) {
            $q->whereTodayIsAvailabilityWeekDay()
                ->whereAvailabilityOpensInTimePeriod();
        });
    }


    public function scopeWhereTodayIsAvailabilityWeekDay($query)
    {
        return $query->where(function ($q) {
            $q->whereNotNull('available_weekday')
                ->where('available_weekday', now()->dayOfWeek);
        });
    }

    public function scopeWhereAvailabilityOpensInTimePeriod($query)
    {
        return $query->where(function ($q) {
            $now = now();
            $q->whereNotNull('available_start_time')
                ->whereNotNull('available_end_time')
                ->whereRaw('available_start_time <= timestamp(?)', [$now->toDateTimeString()])
                ->whereRaw('available_end_time > timestamp(?)', [$now->toDateTimeString()]);
        });
    }

    public function scopeWhereOpenPeriodElapsed($query)
    {
        return $query->whereClosePeriodPast()
                    ->orWhere(function ($q) {
                        $q->whereFormResponseComparesToLimit('>=');
                    });
    }

    public function scopeWhereClosePeriodPast($query)
    {
        return $query->where(function ($q) {
            $q->whereNotNull('close_form_at')
                ->whereRaw('close_form_at < timestamp(?)', [now()->toDateTimeString()]);
        });
    }

    public function scopeOutsideWeekDayOpenPeriod($query)
    {
        return $query->where(function ($q) {
            $q->notOnWeekDay()
                ->orWhere(function ($qu) {
                    $qu->outsideOpenPeriod();
                });
        });
    }

    public function scopeNotOnWeekDay($query)
    {
        return $query->where(function ($q) {
            $q->whereNotNull('available_weekday')
                ->where('available_weekday', '!=', now()->dayOfWeek);
        });
    }

    public function scopeOutsideOpenPeriod($query)
    {
        return $query->where(function ($q) {
            $q->whereNotNull('available_start_time')
                ->whereNotNull('available_end_time')
                ->whereRaw('timestamp(?) not between available_start_time and available_end_time', [now()->toTimeString()]);
        });
    }
}
