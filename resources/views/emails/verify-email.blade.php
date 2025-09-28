@component('mail::message')

Hello {{$user->username}}, <br><br>

<p>Please click the button below to verify your email address.</p>


@component('mail::button', ['url' => $url])
Click to verify
@endcomponent

<p>If you are having challenges you can copy this link below to your browser</p>

{{ $url }}

<p>If you did not create an account, no further action is required.</p>

Thanks,<br>
{{ config('app.name') }}
@endcomponent
