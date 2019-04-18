<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Validation Language Lines
    |--------------------------------------------------------------------------
    |
    | The following language lines contain the default error messages used by
    | the validator class. Some of these rules have multiple versions such
    | as the size rules. Feel free to tweak each of these messages here.
    |
    */

    'accepted' => 'The :attribute must be accepted.',
    'active_url' => 'The :attribute is not a valid URL.',
    'after' => 'The :attribute must be a date after :date.',
    'after_or_equal' => 'The :attribute must be a date after or equal to :date.',
    'alpha' => 'The :attribute may only contain letters.',
    'alpha_dash' => 'The :attribute may only contain letters, numbers, dashes and underscores.',
    'alpha_num' => 'The :attribute may only contain letters and numbers.',
    'array' => 'The :attribute must be an array.',
    'before' => 'The :attribute must be a date before :date.',
    'before_or_equal' => 'The :attribute must be a date before or equal to :date.',
    'between' => [
        'numeric' => 'The :attribute must be between :min and :max.',
        'file' => 'The :attribute must be between :min and :max kilobytes.',
        'string' => 'The :attribute must be between :min and :max characters.',
        'array' => 'The :attribute must have between :min and :max items.',
    ],
    'boolean' => 'The :attribute field must be true or false.',
    'confirmed' => 'The :attribute confirmation does not match.',
    'date' => 'The :attribute is not a valid date.',
    'date_equals' => 'The :attribute must be a date equal to :date.',
    'date_format' => 'The :attribute does not match the format :format.',
    'different' => 'The :attribute and :other must be different.',
    'digits' => 'The :attribute must be :digits digits.',
    'digits_between' => 'The :attribute must be between :min and :max digits.',
    'dimensions' => 'The :attribute has invalid image dimensions.',
    'distinct' => 'The :attribute field has a duplicate value.',
    'email' => 'The :attribute must be a valid email address.',
    'exists' => 'The selected :attribute is invalid.',
    'file' => 'The :attribute must be a file.',
    'filled' => 'The :attribute field must have a value.',
    'gt' => [
        'numeric' => 'The :attribute must be greater than :value.',
        'file' => 'The :attribute must be greater than :value kilobytes.',
        'string' => 'The :attribute must be greater than :value characters.',
        'array' => 'The :attribute must have more than :value items.',
    ],
    'gte' => [
        'numeric' => 'The :attribute must be greater than or equal :value.',
        'file' => 'The :attribute must be greater than or equal :value kilobytes.',
        'string' => 'The :attribute must be greater than or equal :value characters.',
        'array' => 'The :attribute must have :value items or more.',
    ],
    'image' => 'The :attribute must be an image.',
    'in' => 'The selected :attribute is invalid.',
    'in_array' => 'The :attribute field does not exist in :other.',
    'integer' => 'The :attribute must be an integer.',
    'ip' => 'The :attribute must be a valid IP address.',
    'ipv4' => 'The :attribute must be a valid IPv4 address.',
    'ipv6' => 'The :attribute must be a valid IPv6 address.',
    'json' => 'The :attribute must be a valid JSON string.',
    'lt' => [
        'numeric' => 'The :attribute must be less than :value.',
        'file' => 'The :attribute must be less than :value kilobytes.',
        'string' => 'The :attribute must be less than :value characters.',
        'array' => 'The :attribute must have less than :value items.',
    ],
    'lte' => [
        'numeric' => 'The :attribute must be less than or equal :value.',
        'file' => 'The :attribute must be less than or equal :value kilobytes.',
        'string' => 'The :attribute must be less than or equal :value characters.',
        'array' => 'The :attribute must not have more than :value items.',
    ],
    'max' => [
        'numeric' => 'The :attribute may not be greater than :max.',
        'file' => 'The :attribute may not be greater than :max kilobytes.',
        'string' => 'The :attribute may not be greater than :max characters.',
        'array' => 'The :attribute may not have more than :max items.',
    ],
    'mimes' => 'The :attribute must be a file of type: :values.',
    'mimetypes' => 'The :attribute must be a file of type: :values.',
    'min' => [
        'numeric' => 'The :attribute must be at least :min.',
        'file' => 'The :attribute must be at least :min kilobytes.',
        'string' => 'The :attribute must be at least :min characters.',
        'array' => 'The :attribute must have at least :min items.',
    ],
    'not_in' => 'The selected :attribute is invalid.',
    'not_regex' => 'The :attribute format is invalid.',
    'numeric' => 'The :attribute must be a number.',
    'present' => 'The :attribute field must be present.',
    'regex' => 'The :attribute format is invalid.',
    'required' => 'The :attribute field is required.',
    'required_if' => 'The :attribute field is required when :other is :value.',
    'required_unless' => 'The :attribute field is required unless :other is in :values.',
    'required_with' => 'The :attribute field is required when :values is present.',
    'required_with_all' => 'The :attribute field is required when :values are present.',
    'required_without' => 'The :attribute field is required when :values is not present.',
    'required_without_all' => 'The :attribute field is required when none of :values are present.',
    'same' => 'The :attribute and :other must match.',
    'size' => [
        'numeric' => 'The :attribute must be :size.',
        'file' => 'The :attribute must be :size kilobytes.',
        'string' => 'The :attribute must be :size characters.',
        'array' => 'The :attribute must contain :size items.',
    ],
    'string' => 'The :attribute must be a string.',
    'timezone' => 'The :attribute must be a valid zone.',
    'unique' => 'The :attribute has already been taken.',
    'uploaded' => 'The :attribute failed to upload.',
    'url' => 'The :attribute format is invalid.',
    'uuid' => 'The :attribute must be a valid UUID.',

    /*
    |--------------------------------------------------------------------------
    | Custom Validation Language Lines
    |--------------------------------------------------------------------------
    |
    | Here you may specify custom validation messages for attributes using the
    | convention "attribute.rule" to name the lines. This makes it quick to
    | specify a specific custom language line for a given attribute rule.
    |
    */

    'custom' => [
        //form questions
        'short_answer.*.question' => [
            'required' => 'Each short answer question is required',
            'min' => 'Each short answer question must be at least :min characters',
            'max' => 'Each short answer question must not be more than :max characters',
        ],
        'long_answer.*.question' => [
            'required' => 'Each long answer question is required',
            'min' => 'Each long answer question must be at least :min characters',
            'max' => 'Each long answer question must not be more than :max characters',
        ],
        'multiple_choices.*.question' => [
            'required' => 'Each multiple choice question is required',
            'min' => 'Each multiple choice question must be at least :min characters',
            'max' => 'Each multiple choice question must not be more than :max characters',
        ],
        'checkboxes.*.question' => [
            'required' => 'Each checkbox question is required',
            'min' => 'Each checkbox question must be at least :min characters',
            'max' => 'Each checkbox question must not be more than :max characters',
        ],
        'drop_down.*.question' => [
            'required' => 'Each drop down question is required',
            'min' => 'Each drop down question must be at least :min characters',
            'max' => 'Each drop down question must not be more than :max characters',
        ],
        'linear_scale.*.question' => [
            'required' => 'Each linear scale question is required',
            'min' => 'Each linear scale question must be at least :min characters',
            'max' => 'Each linear scale question must not be more than :max characters',
        ],
        'date.*.question' => [
            'required' => 'Each date question is required',
            'min' => 'Each date question must be at least :min characters',
            'max' => 'Each date question must not be more than :max characters',
        ],
        'time.*.question' => [
            'required' => 'Each time question is required',
            'min' => 'Each time question must be at least :min characters',
            'max' => 'Each time question must not be more than :max characters',
        ],
        'multiple_choices.*.options.*' => [
            'required_with' => 'Each multiple choice question must have at least one option',
            'string' => 'Each multiple choice question must have at least one option',
            'min' => 'Each multiple choice question option must be at least :min characters',
            'max' => 'Each multiple choice question option must not be more than :max characters',
        ],
        'checkboxes.*.options.*' => [
            'required_with' => 'Each checkbox question must have at least one option',
            'string' => 'Each checkbox question must have at least one option',
            'min' => 'Each checkbox question option must be at least :min characters',
            'max' => 'Each checkbox question option must not be more than :max characters',
        ],
        'drop_down.*.options.*' => [
            'required_with' => 'Each drop down question must have at least one option',
            'string' => 'Each drop down question must have at least one option',
            'min' => 'Each drop down question option must be at least :min characters',
            'max' => 'Each drop down question option must not be more than :max characters',
        ],
        'linear_scale.*.options.min.value' => [
            'required_with' => 'Each linear scale question must have at least a minimum scale value',
            'in' => 'Invalid minimum scale value'
        ],
        'linear_scale.*.options.min.label' => [
            'min' => 'Each linear scale question minimum label must be at least :min characters',
            'max' => 'Each drop down question minimum label must not be more than :max characters',
        ],
        'linear_scale.*.options.max.value' => [
            'required_with' => 'Each linear scale question must have at least a maximum scale value',
            'in' => 'Invalid maximum scale value'
        ],
        'linear_scale.*.options.max.label' => [
            'min' => 'Each linear scale question maximum label must be at least :min characters',
            'max' => 'Each drop down question maximum label must not be more than :max characters',
        ],

        'emails' => [
            'required' => 'At least one email address is required',
        ],
        'recipients_emails' => [
            'max' => 'The email addresses entered should not be more than :max'
        ],
        'recipients_emails.*' => [
            'email' => 'One (or more) of the email addresses provided is not valid',
            'max' => 'The maximum length for each email address is :max'
        ],
        'collaborator_emails' => [
            'required' => 'At least one collaborator email address is required',
            'max' => 'The email addresses entered should not be more than :max'
        ],
        'collaborator_emails.*' => [
            'email' => 'One (or more) of the email addresses provided is not valid',
            'max' => 'The maximum length for each email address is :max'
        ],
        'open_form_date' => [
            'required' => 'The date for which the form is open is required',
            'date' => 'The date for which the form is open is invalid'
        ],
        'open_form_time' => [
            'required' => 'The time for which the form is open is required',
            'date_format' => 'The time for which the form is open is invalid'
        ],
        'open_form_at' => [
            'date_format' => 'The date or time for which the form is open is invalid',
            'after' => 'The date and time for which the form is open must be after the current date and time',
        ],
        'close_form_date' => [
            'required' => 'The date for which the form is closed or the response limit must be specified',
            'date' => 'The date for which the form is closed is invalid'
        ],
        'close_form_time' => [
            'required' => 'The time for which the form is open is required',
            'date_format' => 'The time for which the form is open is invalid'
        ],
        'close_form_at' => [
            'date_format' => 'The date or time for which the form is closed is invalid',
            'after' => 'The date and time for which the form is open must be after when the form is open',
        ],
        'response_limit' => [
            'required' => 'Either the date and time for which the form is closed or the response limit must be specified',
            'min' => 'The response limit must not be less than :min',
            'max' => 'The response limit must not be more than :max',
        ],
        'weekday' => [
            'required' => 'The day of the week the form should be open is required',
            'in' => 'The week day is invalid',
        ],
        'start_time' => [
            'required' => 'The day time of the week to open the form is required',
            'date_format' => 'The day time of the week to open the form is invalid',
        ],
        'end_time' => [
            'required' => 'The day time of the week to close the form is required',
            'date_format' => 'The day time of the week to close the form is invalid',
            'after' => 'The day time of the week to close the form must be after the time to open the form'
        ],
        'closed_form_message' => [
            'min_words' => 'The closed form message should be at least 3 words',
            'max' => 'The closed form message should not be more than :max characters'
        ]
    ],

    /*
    |--------------------------------------------------------------------------
    | Custom Validation Attributes
    |--------------------------------------------------------------------------
    |
    | The following language lines are used to swap our attribute placeholder
    | with something more reader friendly such as "E-Mail Address" instead
    | of "email". This simply helps us make our message more expressive.
    |
    */

    'attributes' => [],

];
