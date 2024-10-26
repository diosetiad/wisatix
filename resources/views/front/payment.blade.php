<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <meta http-equiv="X-UA-Compatible" content="ie=edge" />
        @vite("resources/css/app.css")
        <title>Payment - Wisatix</title>
    </head>
    <body class="relative mx-auto max-w-[640px] bg-[#F8F8F9]">
        <div class="fixed top-0 z-0 h-screen w-full max-w-[640px]">
            <div
                class="absolute z-0 h-[459px] w-full bg-[linear-gradient(180deg,#000000_12.61%,rgba(0,0,0,0)_70.74%)]"
            ></div>

            <img
                src="{{ Storage::url($ticket->thumbnail) }}"
                alt="Ticket background"
                class="h-full w-full object-cover"
            />
        </div>

        <x-header
            :title="'Payment'"
            :backRoute="route('front.booking', $ticket->slug)"
        />

        <main
            class="relative mt-5 flex w-full flex-col overflow-x-hidden pb-10"
        >
            <form
                method="POST"
                enctype="multipart/form-data"
                action="{{ route("front.payment-store") }}"
                class="flex flex-col gap-[18px] px-4"
            >
                @csrf
                <section class="flex flex-col">
                    <x-ticket-card
                        :thumbnail="$ticket->thumbnail"
                        :name="$ticket->name"
                        :providerName="$ticket->provider->name"
                        :price="$ticket->price"
                        :rating="$ticket->rating"
                        :showInput="true"
                    />
                </section>

                <section class="flex flex-col">
                    <ul
                        class="flex flex-col gap-[14px] rounded-[30px] bg-white p-5"
                    >
                        @php
                            $fields = [
                                [
                                    "label" => "Total People",
                                    "value" => $booking["total_participant"] . " Participant",
                                ],
                                [
                                    "label" => "Sub Total",
                                    "value" => "Rp " . number_format($booking["sub_total"], 0, ",", "."),
                                ],
                                [
                                    "label" => "VAT 11%",
                                    "value" => "Rp " . number_format($booking["total_vat"], 0, ",", "."),
                                ],
                                [
                                    "label" => "Discount 0%",
                                    "value" => "Rp 0",
                                ],
                                [
                                    "label" => "Insurance",
                                    "value" => "Included 100%",
                                ],
                                [
                                    "label" => "Grand Total",
                                    "value" => "Rp " . number_format($booking["total_amount"], 0, ",", "."),
                                    "isGrandTotal" => true,
                                ],
                            ];
                        @endphp

                        @foreach ($fields as $field)
                            <li class="flex items-center justify-between">
                                <span class="text-sm font-semibold">
                                    {{ $field["label"] }}
                                </span>

                                <span
                                    class="{{ isset($field["isGrandTotal"]) ? "text-[22px] font-bold text-[#F97316]" : "text-sm font-semibold" }}"
                                >
                                    {{ $field["value"] }}
                                </span>
                            </li>
                        @endforeach
                    </ul>
                </section>

                <section class="flex flex-col">
                    <div
                        class="flex flex-col gap-6 rounded-[30px] bg-white p-5"
                    >
                        <div class="flex flex-col gap-[6px]">
                            <h3 class="text-sm font-semibold">
                                Payment Method
                            </h3>

                            <div class="grid grid-cols-2 gap-[10px]">
                                @php
                                    $paymentMethod = [
                                        [
                                            "label" => "Transfer Bank",
                                            "for" => "transfer",
                                            "icon" => "security-card-black.svg",
                                            "alt" => "Bank",
                                        ],
                                        [
                                            "label" => "Credit Card",
                                            "for" => "credit",
                                            "icon" => "cards.svg",
                                            "alt" => "Credit card",
                                        ],
                                    ];
                                @endphp

                                @foreach ($paymentMethod as $payment)
                                    <label
                                        for="{{ $payment["for"] }}"
                                        class="relative cursor-pointer"
                                    >
                                        <input
                                            type="radio"
                                            name="payment-method"
                                            id="{{ $payment["for"] }}"
                                            class="peer absolute left-1/2 top-1/2 opacity-0"
                                            required
                                        />

                                        <div
                                            class="flex h-full items-center gap-[6px] rounded-full bg-[#F8F8F9] p-[14px_12px] transition-all duration-300 peer-checked:ring-1 peer-checked:ring-[#F97316]"
                                        >
                                            <img
                                                src="{{ asset("assets/icons/" . $payment["icon"]) }}"
                                                alt="{{ $payment["alt"] }} icon"
                                                class="h-6 w-6"
                                            />

                                            <span class="text-sm font-semibold">
                                                {{ $payment["label"] }}
                                            </span>
                                        </div>
                                    </label>
                                @endforeach
                            </div>
                        </div>

                        @php
                            $banks = [
                                [
                                    "name" => "WISATIX",
                                    "number" => "5630714592",
                                    "logo" => "bca.svg",
                                    "alt" => "BCA",
                                ],
                                [
                                    "name" => "WISATIX",
                                    "number" => "5479252376",
                                    "logo" => "mandiri.svg",
                                    "alt" => "Mandiri",
                                ],
                            ];
                        @endphp

                        @foreach ($banks as $bank)
                            <div class="flex items-center gap-3">
                                <div class="h-[50px] w-[70px] overflow-hidden">
                                    <img
                                        src="{{ asset("assets/logos/" . $bank["logo"]) }}"
                                        class="h-full w-full object-contain"
                                        alt="{{ $bank["alt"] }} logo"
                                    />
                                </div>

                                <div class="flex flex-col">
                                    <span class="font-semibold">
                                        {{ $bank["name"] }}
                                    </span>

                                    <span>{{ $bank["number"] }}</span>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </section>

                <section class="flex flex-col">
                    <div
                        class="flex flex-col gap-6 rounded-[30px] bg-white p-5"
                    >
                        <h3 class="text-sm font-semibold">Proof of Payment</h3>

                        <div
                            class="relative flex w-full items-center gap-[10px] rounded-full bg-[#F8F8F9] px-5 transition-all duration-300"
                        >
                            <div class="flex h-6 w-6 shrink-0">
                                <img
                                    src="{{ asset("assets/icons/receipt-2.svg") }}"
                                    alt="Proof icon"
                                />
                            </div>

                            <button
                                type="button"
                                id="upload-btn"
                                class="w-full appearance-none overflow-hidden py-[14px] text-left text-sm outline-none"
                                onclick="document.getElementById('proof').click()"
                            >
                                Upload file
                            </button>

                            <img
                                src="{{ asset("assets/icons/verify.svg") }}"
                                class="flex h-6 w-6 shrink-0"
                                alt="Verified icon"
                            />

                            <input
                                type="file"
                                name="proof"
                                id="proof"
                                required
                                class="absolute opacity-0"
                            />
                        </div>

                        <button
                            type="submit"
                            class="flex w-full items-center justify-between gap-4 rounded-full bg-[#13181D] p-1 pl-5"
                        >
                            <span class="font-bold text-white">
                                Confirm My Payment
                            </span>

                            <img
                                src="{{ asset("assets/icons/card-tick.svg") }}"
                                alt="Confirm icon"
                                class="h-[50px] w-[50px]"
                            />
                        </button>
                    </div>
                </section>
            </form>
        </main>

        @vite("resources/js/front/payment.js")
    </body>
</html>
