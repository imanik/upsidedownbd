@component('mail::message')
# Ticket Payment Successful

<p>{{ $params['message'] }} </p>

@component('mail::button', ['url' => route('ticket.detail', $params['reference'])])
Ticket Detail
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
