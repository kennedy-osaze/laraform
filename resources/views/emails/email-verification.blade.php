@component('mail::message')
### Hello {{ $user->first_name }},

Thank you for signing up on **[{{ config('app.name') }}]({{ url('/') }})** To complete your signup, please verify your email by clicking on the button below:

@component('mail::button', ['url' => url("activate/account/{$user->email_token}"), 'color' => 'success'])
Verify Email Address
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
