@component('mail::message')
Dear {{$username}},<br><br>

<p>Congrats, you have been credited with ${{ $amount}} from the user {{ $ref_username}} whom you referred </p>
<p>
Kindly login to your dashboard to access the bonus
</p>

<p>Thank you for your cooperation!</p><br><br>

<p>Kind regards,</p><br><br>

<p> {{ config('app.name','site name') }}Team</p><br><br>

@component('mail::button', ['url' => $url])
WEBSITE
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
