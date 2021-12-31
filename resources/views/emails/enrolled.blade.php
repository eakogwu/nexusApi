@component('mail::message')
# Dear {{ $enroll->firstname  }}
Your registration was successfull, we'll get in touch with you shortly

Thanks,<br>
{{ config('app.name') }}
@endcomponent
