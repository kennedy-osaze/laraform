<?php

namespace App\Jobs;

use App\Form;
use App\FormAvailability;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;

class CloseScheduledForm implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $form_availability_query = FormAvailability::with('form.responses')
            ->whereFormReadyForClose()
            ->where(function ($query) {
                $query->whereOpenPeriodElapsed()
                    ->orWhere(function ($q) {
                        $q->outsideWeekDayOpenPeriod();
                    });
            });

        if ($form_availability_query->exists()) {
            $form_availability_query->each(function (FormAvailability $availability) {
                $form = $availability->form;
                $form->status = Form::STATUS_CLOSED;
                $form->save();
            }, 200);
        }
    }
}
