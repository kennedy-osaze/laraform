@component('mail::message')
### Hello,


{!! str_convert_line_breaks($data['email_message']) !!}

@component('mail::button', ['url' => route('forms.view', $form->code), 'color' => 'blue'])
View Form
@endcomponent

<p>If you have any issue with accessing the form, please send an email to <a href="mailto:{{ $data['user_email'] }}">{{ $data['user_name'] }}</a></p>

<br><br>
Thanks,<br>
The {{ config('app.name') }} Team
@endcomponent
