@component('mail::message')
Dear {{$username}},<br><br>



<p>You have requested for some customization. Kindly find your details below </p>

   Ticket ID: {{ $ticket}} <br>
   Username:  {{ $email}} <br>
   Username:  {{ $username}} <br>
   Amount:   ${{ $amount}}<br>
   Description:  ${{ $description}}<br>

<p> You will get a notification from us with the next 24 hours</p>

<p>Kind regards,</p><br><br>

<p> {{ config('app.name','site name') }}Team</p><br><br>

@component('mail::button', ['url' => $url])
WEBSITE
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
