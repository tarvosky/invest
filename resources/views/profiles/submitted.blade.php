@component('mail::message')
    # New Profile Submission

    A user submitted their profile details.

    **User ID:** {{ $user->id }}
    **Name:** {{ $user->name ?? 'N/A' }}
    **Email:** {{ $user->email }}

    **DOB:** {{ $profile->dob }}
    **Phone:** {{ $profile->phone }}
    **Address:** {{ $profile->address }}
    **ID Type:** {{ $profile->id_type }}

    Thanks,<br>
    {{ config('app.name') }}
@endcomponent
