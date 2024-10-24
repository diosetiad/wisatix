<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <meta http-equiv="X-UA-Compatible" content="ie=edge" />
        @vite("resources/css/app.css")
        <title>Booking {{ $ticket->name }} - Wisatix</title>
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
            :title="'Book a Ticket'"
            :backRoute="route('front.details', $ticket->slug)"
        />

        <main
            class="relative mt-5 flex w-full flex-col overflow-x-hidden pb-10"
        >
            <form
                method="POST"
                action="{{ route("front.booking-store", $ticket->slug) }}"
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
                                    "label" => "Full Name",
                                    "type" => "text",
                                    "name" => "name",
                                    "icon" => "user-octagon.svg",
                                    "alt" => "Name",
                                    "placeholder" => "Write your complete name",
                                ],
                                [
                                    "label" => "Email",
                                    "type" => "email",
                                    "name" => "email",
                                    "icon" => "sms.svg",
                                    "alt" => "Email",
                                    "placeholder" => "Write your email",
                                ],
                                [
                                    "label" => "Phone Number",
                                    "type" => "tel",
                                    "name" => "phone_number",
                                    "icon" => "mobile.svg",
                                    "alt" => "Phone",
                                    "placeholder" => "Give us your number",
                                ],
                                [
                                    "label" => "Choose Date",
                                    "type" => "date",
                                    "name" => "started_at",
                                    "icon" => "clock.svg",
                                    "alt" => "Date",
                                    "placeholder" => "Set your date",
                                ],
                            ];
                        @endphp

                        @foreach ($fields as $field)
                            <li class="flex flex-col gap-[6px]">
                                <label
                                    for="{{ $field["name"] }}"
                                    class="text-sm font-semibold"
                                >
                                    {{ $field["label"] }}
                                </label>

                                <div
                                    class="{{ $errors->has($field["name"]) ? "ring-1 ring-red-500" : "" }} flex items-center gap-[10px] rounded-full bg-[#F8F8F9] px-5 transition-all duration-300 focus-within:ring-1 focus-within:ring-[#F97316]"
                                >
                                    <img
                                        src="{{ asset("assets/icons/" . $field["icon"]) }}"
                                        alt="{{ $field["alt"] }} icon"
                                        class="h-6 w-6"
                                    />

                                    <input
                                        type="{{ $field["type"] }}"
                                        name="{{ $field["name"] }}"
                                        id="{{ $field["name"] }}"
                                        value="{{ old($field["name"]) }}"
                                        placeholder="{{ $field["placeholder"] }}"
                                        autocomplete="off"
                                        required
                                        class="w-full appearance-none !bg-transparent py-[14px] text-sm font-semibold outline-none placeholder:font-normal placeholder:text-[#13181D]"
                                    />
                                </div>

                                @error($field["name"])
                                    <span class="text-sm text-red-500">
                                        {{ $message }}
                                    </span>
                                @enderror
                            </li>
                        @endforeach
                    </ul>
                </section>

                <section class="flex flex-col">
                    <div
                        class="flex flex-col gap-6 rounded-[30px] bg-white p-5"
                    >
                        <div class="flex items-center justify-between">
                            <span class="font-bold">Quantity</span>

                            <div
                                id="counter"
                                class="flex w-fit min-w-[135px] items-center justify-between gap-[14px] rounded-full bg-[#F8F8F9] p-[14px_20px]"
                            >
                                <button
                                    type="button"
                                    id="minus"
                                    class="h-6 w-6"
                                >
                                    <img
                                        src="{{ asset("assets/icons/minus.svg") }}"
                                        alt="Minus icon"
                                    />
                                </button>

                                <span id="count-text" class="font-bold">1</span>

                                <input
                                    type="number"
                                    name="total_participant"
                                    id="people"
                                    value="{{ old("total_participant", 1) }}"
                                    required
                                    class="hidden"
                                />

                                <button type="button" id="plus" class="h-6 w-6">
                                    <img
                                        src="{{ asset("assets/icons/add.svg") }}"
                                        alt="Plus icon"
                                    />
                                </button>
                            </div>
                        </div>

                        <div class="flex items-center justify-between">
                            <span class="text-sm font-semibold">Sub Total</span>

                            <span
                                id="total-price"
                                class="text-[22px] font-bold text-[#F97316]"
                            ></span>
                        </div>

                        <input type="hidden" name="sub_total" id="sub-total" />

                        <input type="hidden" name="total_vat" id="total-vat" />

                        <input
                            type="hidden"
                            name="total_amount"
                            id="total-amount"
                        />

                        <button
                            type="submit"
                            class="flex w-full items-center justify-between gap-4 rounded-full bg-[#13181D] p-1 pl-5"
                        >
                            <span class="font-bold text-white">
                                Continue to Checkout
                            </span>

                            <img
                                src="{{ asset("assets/icons/card.svg") }}"
                                class="h-[50px] w-[50px]"
                                alt="Checkout icon"
                            />
                        </button>
                    </div>
                </section>
            </form>
        </main>

        @vite("resources/js/front/booking.js")
    </body>
</html>
