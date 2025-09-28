@component('mail::message')
Dear {{$username}},<br><br>

Thank you for being a part of Autoverified. <br> <br>

<p>{{ $description}}</p>


<p>Kind regards,</p><br><br>

<p> {{ config('app.name','site name') }}Team</p><br><br>

@component('mail::button', ['url' => $url])
WEBSITE
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
