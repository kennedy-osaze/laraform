<?php

namespace App\Http\Controllers\Form;

use Auth;
use App\Form;
use Validator;
use App\FormAvailability;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class FormAvailabilityController extends Controller
{
    public function save(Request $request, $form)
    {
        if ($request->ajax()) {
            $current_user = Auth::user();

            $form = Form::where('code', $form)->first();
            if (!$form || $form->user_id !== $current_user->id) {
                return response()->json([
                    'success' => false,
                    'error_message' => 'not_found',
                    'error' => 'Form is invalid'
                ]);
            }

            if (empty(array_filter($request->except('_token'), function ($value) { return $value !== null; }))) {
                return response()->json([
                    'success' => false,
                    'error_message' => 'validation_failed',
                    'error' => 'The form availability settings has to be filled',
                ]);
            }

            $request->merge([
                'open_form_time' => isset($request->open_form_time) ? "{$request->open_form_time}:00" : null,
                'close_form_time' => isset($request->close_form_time) ? "{$request->close_form_time}:00" : null,
                'start_time' => isset($request->start_time) ? "{$request->start_time}:00" : null,
                'end_time' => isset($request->end_time) ? "{$request->end_time}:00" : null,
            ]);

            $request->merge([
                'open_form_at' => trim($request->open_form_date . ' ' . $request->open_form_time) ?: null,
                'close_form_at' => trim($request->close_form_date . ' ' . $request->close_form_time) ?: null
            ]);

            $validator = Validator::make($request->all(), $this->generateValidationRules($request, $form));

            if ($validator->fails()) {
                return response()->json([
                    'success' => false,
                    'error_message' => 'validation_failed',
                    'error' => $validator->errors()->first()
                ]);
            }

            $availability = $form->availability ?? new FormAvailability();
            $availability->open_form_at = $request->open_form_at;
            $availability->close_form_at = $request->close_form_at;
            $availability->response_count_limit = $request->response_limit;
            $availability->available_weekday = $request->weekday;
            $availability->available_start_time = $request->start_time;
            $availability->available_end_time = $request->end_time;
            $availability->closed_form_message = $request->closed_form_message;
            $form->availability()->save($availability);

            return response()->json([
                'success' => true,
            ]);
        }
    }

    public function reset($form)
    {
        if (request()->ajax()) {
            $current_user = Auth::user();

            $form = Form::where('code', $form)->first();
            if (!$form || $form->user_id !== $current_user->id) {
                return response()->json([
                    'success' => false,
                    'error_message' => 'not_found',
                    'error' => 'Form is invalid'
                ]);
            }

            if (!($availability = $form->availability)) {
                return response()->json([
                    'success' => false,
                    'error_message' => 'bad_request',
                    'error' => 'Availability settings for this form is not set yet'
                ]);
            }

            $availability->delete();

            return response()->json([
                'success' => true
            ]);
        }
    }

    protected function generateValidationRules(Request $request, Form $form)
    {
        $rules = [];
        $data = $request->all();

        if ($data['open_form_date'] || $data['open_form_time'] || $data['close_form_at'] || $data['response_limit']) {
            $form_availability = $form->availability;

            //Make after:now rule apply to open_form_at if availability is new or it is to be changed
            $rule_option = (optional($form_availability)->open_form_at === $data['open_form_at']) ? '' : '|after:now';

            $rules['open_form_date'] = 'required|date';
            $rules['open_form_time'] = 'required|date_format:H:i:s';

            $rules['open_form_at'] = "bail|date_format:Y-m-d H:i:s{$rule_option}";
        }

        if ($data['open_form_at']) {
            $rule_option = (!empty($data['response_limit'])) ? 'nullable' : 'required';

            $rules['close_form_date'] = "{$rule_option}|date";
            $rules['close_form_time'] = "{$rule_option}|date_format:H:i:s";

            $rules['close_form_at'] = "bail|{$rule_option}|date_format:Y-m-d H:i:s|after:{$data['open_form_at']}";
        }

        if ($data['open_form_at']) {
            $rule_option = (!empty($data['close_form_at'])) ? 'nullable' : 'required';
            $rules['response_limit'] = "{$rule_option}|integer|min:1|max:999999999";
        }

        if ($data['start_time'] || $data['end_time']) {
            $rules['weekday'] = 'required|integer|in:' . implode(',', range(0, 6));
        }

        if ($data['weekday'] || $data['end_time']) {
            $rules['start_time'] = 'required|date_format:H:i:s';
        }

        if ($data['weekday'] || $data['start_time']) {
            $rules['end_time'] = 'required|date_format:H:i:s|after:start_time';
        }

        $rules['closed_form_message'] = 'nullable|string|min_words:3|max:30000';

        return $rules;
    }
}
