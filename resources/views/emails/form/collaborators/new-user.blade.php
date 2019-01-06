@component('mail::message')
### Hello,

You have been invited to **[{{ config('app.name') }}]({{ url('/') }})** as a form collaborator to the form - [{{ $form->title }}]({{ route('forms.show', $form->code) }}) by {{ $form->user->full_name }}.

@if ($email_message)
{!! str_convert_line_breaks($email_message) !!}
<br>
@endif

To be able to access this form, you will need to create an account. Click the button below to do so.

@component('mail::button', ['url' => route('register', ['code' => $user->email_token]), 'color' => 'success'])
Create Account
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
