@component('mail::message')
Dear {{$username}},<br><br>


<p>You have requested to withdraw ${{$amount}}. Kindly find your details below </p>

   Ticket ID: {{ $ticket}} <br>
   Username:  {{ $username}} <br>
   Amount:   ${{ $amount}}<br>

<p> Funds should be disbursed within the next 48 hours</p>

<p>Thank you for your cooperation!</p><br><br>

<p>Kind regards,</p><br><br>

<p> {{ config('app.name','site name') }}Team</p><br><br>

@component('mail::button', ['url' => $url])
WEBSITE
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
