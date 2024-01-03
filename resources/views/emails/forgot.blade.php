@component('mail::message')
Hello {{ $user->name }},

<p>We understand it</p>

@component('mail::button', ['url' => url('reset/'. $user->remember_token )])
    Reset your password
@endcomponent

<p>Please contact us</p>

Thanks,<br>
{{ config('app.name') }}
@endcomponent
