@component('mail::message')
Dear Admin,<br><br>



<p>A custom request has been made. The image has been attached to this email, kindly find your details below </p>

   Ticket ID: {{ $ticket}} <br>
   Username:  {{ $email}} <br>
   Username:  {{ $username}} <br>
   Amount:   ${{ $amount}}<br>
   Description:  ${{ $description}}<br>



<p>Kind regards,</p><br><br>

<p> {{ config('app.name','site name') }}Team</p><br><br>

@component('mail::button', ['url' => $url])
WEBSITE
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
