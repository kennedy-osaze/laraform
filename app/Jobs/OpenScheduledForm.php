<?php

namespace App\Jobs;

use App\Form;
use App\FormAvailability;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;

class OpenScheduledForm implements ShouldQueue
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
            ->whereFormReadyForOpen()
            ->whereAvailabilityBetweenStartAndEnd()
            ->orWhere(function ($query) {
                $query->whereAvailabilityOpensWithinSpecifiedPeriod();
            });

        if ($form_availability_query->exists()) {
            $form_availability_query->chunk(200, function ($availabilities) {
                foreach ($availabilities as $availability) {
                    $form_responses = $availability->form->responses;

                    if (!$availability->response_count_limit || ($form_responses->count() < $availability->response_count_limit)) {
                        $form = $availability->form;
                        $form->status = Form::STATUS_OPEN;
                        $form->save();
                    }
                }
            });
        }
    }
}
