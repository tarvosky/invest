@component('mail::message')
Dear Admin,<br><br>

   User: {{$username}}<br>
   Email: {{$email}}<br>
   Ticket ID: {{ $ticket}} <br>
   Subject: {{ $subject}}<br>
   Department: Technical Support<br><br>

<hr>
{{$comment}}


Thanks,<br>
{{ config('app.name') }}
@endcomponent
