@component('mail::message')
Dear Admin,<br><br>

<p>Payment has been made into the wallet</p>



   Username:  {{ $username}} <br>
   Amount:    ${{ $amount}}<br>




<p> {{ config('app.name','site name') }}Team</p><br><br>

@component('mail::button', ['url' => $url])
WEBSITE
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
