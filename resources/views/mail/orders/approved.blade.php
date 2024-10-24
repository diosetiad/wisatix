<x-mail::message>
Hi {{ $booking->name }}, your order with booking code {{ $booking->booking_trx_id }} has been successful! please come to the counter to exchange it for a real ticket.

<x-mail::button :url="route('front.check-booking')">
Check Booking
</x-mail::button>

Thanks,<br>
{{ config('app.name') }}
</x-mail::message>
