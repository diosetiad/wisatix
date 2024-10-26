<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <meta http-equiv="X-UA-Compatible" content="ie=edge" />
        @vite("resources/css/app.css")
        <title>Check Booking Details - Wisatix</title>
    </head>
    <body class="relative mx-auto max-w-[640px] bg-[#F8F8F9]">
        <div class="fixed top-0 z-0 h-screen w-full max-w-[640px]">
            <div
                class="absolute z-0 h-[459px] w-full bg-[linear-gradient(180deg,#000000_12.61%,rgba(0,0,0,0)_70.74%)]"
            ></div>

            <img
                src="{{ Storage::url($bookingDetails->ticket->thumbnail) }}"
                alt="Ticket background"
                class="h-full w-full object-cover"
            />
        </div>

        <x-header
            :title="'Booking Details'"
            :backRoute="route('front.index')"
        />

        <main
            class="relative mt-5 flex w-full flex-col gap-[18px] overflow-x-hidden pb-10"
        >
            <section class="flex flex-col px-4">
                <x-ticket-card
                    :thumbnail="$bookingDetails->ticket->thumbnail"
                    :name="$bookingDetails->ticket->name"
                    :providerName="$bookingDetails->ticket->provider->name"
                    :price="$bookingDetails->ticket->price"
                    :rating="$bookingDetails->ticket->rating"
                    :showInput="true"
                />
            </section>

            <section class="flex flex-col px-4">
                <div
                    class="relative mx-auto w-full max-w-[361px] shrink-0 overflow-hidden rounded-3xl bg-white"
                >
                    <div class="flex flex-col gap-6 p-5 pb-[30px]">
                        <img
                            src="{{ asset("assets/icons/ticket-star.svg") }}"
                            alt="Ticket icon"
                            class="mx-auto h-20 w-20"
                        />

                        <ul class="flex h-full shrink-0 flex-col gap-[14px]">
                            @php
                                $fields = [
                                    [
                                        "label" => "Booking TRX ID",
                                        "value" => $bookingDetails->booking_trx_id,
                                        "isBookingTrxId" => true,
                                    ],
                                    [
                                        "label" => "Started At",
                                        "value" => $bookingDetails->started_at->format("M d, Y"),
                                        "isStartedAt" => true,
                                    ],
                                    [
                                        "label" => "Total People",
                                        "value" => $bookingDetails->total_participant . " Participant",
                                    ],
                                    [
                                        "label" => "Insurance",
                                        "value" => "Included 100%",
                                    ],
                                    [
                                        "label" => "Grand Total",
                                        "value" => "Rp " . number_format($bookingDetails["total_amount"], 0, ",", "."),
                                        "isGrandTotal" => true,
                                    ],
                                ];
                            @endphp

                            @foreach ($fields as $field)
                                <li class="flex items-center justify-between">
                                    <span class="text-sm font-bold">
                                        {{ $field["label"] }}
                                    </span>

                                    <span
                                        @class([
                                            "text-sm font-bold",
                                            "text-xl" => isset($field["isBookingTrxId"]),
                                            "text-[#FF1927]" => isset($field["isStartedAt"]),
                                            "text-xl text-[#F97316]" => isset($field["isGrandTotal"]),
                                        ])
                                    >
                                        {{ $field["value"] }}
                                    </span>
                                </li>
                            @endforeach

                            <li class="flex items-center justify-between">
                                <span class="text-sm font-bold">
                                    Payment Status
                                </span>
                                @if ($bookingDetails->is_paid)
                                    <span
                                        class="w-fit rounded-full bg-[#07B704] p-[6px_12px] text-xs font-bold text-white"
                                    >
                                        SUCCESS
                                    </span>
                                @else
                                    <span
                                        class="w-fit rounded-full bg-[#13181D] p-[6px_12px] text-xs font-bold text-white"
                                    >
                                        PENDING
                                    </span>
                                @endif
                            </li>
                        </ul>

                        <hr
                            class="mx-auto w-full border border-dashed border-[#D0D5DC]"
                        />

                        <div
                            class="flex items-center gap-[10px] rounded-[20px] bg-[#F8F8F9] p-[10px]"
                        >
                            <img
                                src="{{ asset("assets/icons/ticket-star-black.svg") }}"
                                alt="Ticket icon"
                                class="h-8 w-8"
                            />

                            <p>
                                Use code
                                <span class="font-bold">
                                    {{ $bookingDetails->booking_trx_id }}
                                </span>
                                when redeeming for a genuine ticket.
                            </p>
                        </div>
                    </div>
                </div>
            </section>
        </main>
    </body>
</html>
