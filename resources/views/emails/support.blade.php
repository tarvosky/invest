@component('mail::message')
Dear {{$username}},<br><br>

<p>Thank you for contacting us. This is an automated response confirming the receipt of your ticket. Our team will be reviewing your ticket and will be issuing a response as soon as possible. In the meantime, please ensure that the ‘Ticket ID’ is noted in the ‘Subject’ line so we are able to keep track of all communication.</p>

   Ticket ID: {{ $ticket}} <br>
   Subject: {{ $subject}}<br>
   Department: Technical Support<br><br>

<p>Please note that we take your ticket very seriously hence we aim to reply you as soon as possible as each support ticket is replied to in an orderly fashion. Certain issues will require more attention than others which may result in extended response times. Please rest assured that we’re doing our very best to attend to your ticket.
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
