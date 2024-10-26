<x-mail::message>
Hi {{ $booking->name }}, thank you for ordering tour tickets at Wisatix. We are currently checking your payment, you can check it periodically on our website, and here is your booking transaction ID: {{ $booking->booking_trx_id }}

<x-mail::button :url="route('front.check-booking')">
Check Booking
</x-mail::button>

Thanks,<br>
{{ config('app.name') }}
</x-mail::message>
