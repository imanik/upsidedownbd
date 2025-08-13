@component('mail::message')
# Login credentials


<p>{{ $message }} </p>


<p> Go through the link <a href="www.upsidedownbd.com/ticket" blank='#'>www.upsidedownbd.com/ticket</a>
     and use coupon to get 30% discount from Lalmatia and Uttara Gallery</p>

@component('mail::button', ['url' => route('buy_ticket')])
USE Coupon
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
