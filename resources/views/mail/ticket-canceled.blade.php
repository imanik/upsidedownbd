@component('mail::message')
# Ticket Booking Canceled

<p>{{ $params['message'] }} </p>

Thanks,<br>
{{ config('app.name') }}
@endcomponent
