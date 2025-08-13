@component('mail::message')
# Bundle Payment Successful

<p>{{ $params['message'] }} </p>

@component('mail::button', ['url' => route('bundle.detail', $params['reference'])])
Bundle Detail
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
