@component('mail::message')
Dear {{$username}},<br><br>



<p>{{ $content}}</p>




<p>Kind regards,</p><br><br>

<p> {{ config('app.name','site name') }}Team</p><br><br>

@component('mail::button', ['url' => $url])
WEBSITE
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
