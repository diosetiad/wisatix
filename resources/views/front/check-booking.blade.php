<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <meta http-equiv="X-UA-Compatible" content="ie=edge" />
        @vite("resources/css/app.css")
        <title>Check Booking - Wisatix</title>
    </head>
    <body class="mx-auto max-w-[640px] bg-[#F8F8F9]">
        <main
            class="m-auto flex w-full items-center justify-center overflow-x-hidden px-4"
        >
            <section class="flex flex-col">
                <form
                    method="POST"
                    action="{{ route("front.check-booking-details") }}"
                    class="flex w-full max-w-[329px] shrink-0 flex-col gap-6 rounded-[30px] bg-white p-5"
                >
                    @csrf
                    <img
                        src="{{ asset("assets/icons/ticket-star.svg") }}"
                        alt="Ticket icon"
                        class="mx-auto h-20 w-20"
                    />

                    <h1 class="text-center text-2xl font-bold">
                        View Your Tickets
                    </h1>

                    @if ($errors->any())
                        <div class="text-center text-sm text-red-500">
                            @foreach ($errors->all() as $error)
                                <p>{{ $error }}</p>
                            @endforeach
                        </div>
                    @endif

                    @php
                        $fields = [
                            [
                                "label" => "Booking ID",
                                "icon" => "user-octagon.svg",
                                "alt" => "Booking id",
                                "for" => "booking_trx_id",
                                "type" => "text",
                                "placeholder" => 'What\'s your booking ID',
                            ],
                            [
                                "label" => "Phone Number",
                                "icon" => "mobile.svg",
                                "alt" => "Phone",
                                "for" => "phone_number",
                                "type" => "tel",
                                "placeholder" => 'What\'s your number',
                            ],
                        ];
                    @endphp

                    @foreach ($fields as $field)
                        <div class="flex flex-col gap-[6px]">
                            <label
                                for="{{ $field["for"] }}"
                                class="text-sm font-semibold"
                            >
                                {{ $field["label"] }}
                            </label>

                            <div
                                class="flex items-center gap-[10px] rounded-full bg-[#F8F8F9] px-5 transition-all duration-300 focus-within:ring-1 focus-within:ring-[#F97316]"
                            >
                                <img
                                    src="{{ asset("assets/icons/" . $field["icon"]) }}"
                                    alt="{{ $field["alt"] }} icon"
                                    class="h-6 w-6"
                                />

                                <input
                                    type="{{ $field["type"] }}"
                                    name="{{ $field["for"] }}"
                                    id="{{ $field["for"] }}"
                                    autocomplete="off"
                                    placeholder="{{ $field["placeholder"] }}"
                                    required
                                    class="w-full appearance-none !bg-transparent py-[14px] text-sm font-semibold outline-none placeholder:font-normal placeholder:text-[#13181D]"
                                />
                            </div>
                        </div>
                    @endforeach

                    <button
                        type="submit"
                        class="w-full rounded-full bg-[#F97316] p-[14px_20px] text-center font-bold text-white"
                    >
                        Find Now
                    </button>
                </form>
            </section>
        </main>

        @include("components.navbar")
    </body>
</html>
