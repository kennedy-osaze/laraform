@component('mail::message')
### Hello {{ $user->first_name }},

You have been invited by {{ $form->user->full_name }} to be a collaborator for the form - {{ $form->title }}.

@if ($email_message)
{!! str_convert_line_breaks($email_message) !!}
<br>
@endif

Click the link below to access the form:

@component('mail::button', ['url' => route('forms.show', $form->code), 'color' => 'blue'])
View Form
@endcomponent

@component('mail::panel')
<p style="text-align: center">
If you need any help or have any suggestion, kindly send us a mail at:<br>
<a href="mailto:{{ config('mail.from.address') }}">{{ config('mail.from.address') }}</a>
</p>
@endcomponent

<br><br>
Thanks,<br>
The {{ config('app.name') }} Team
@endcomponent
