@component('mail::message')
# Login credentials


<p>{{ $message }} </p>

<ul>
    <li>Name: {{ $name }}</li>
    <li>Mobile: {{ $mobile }}</li>
    <li>Email: {{ $email }}</li>
    <li>Password: {{ $password }}</li>
</ul>

@component('mail::button', ['url' => route('login')])
Login here
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
