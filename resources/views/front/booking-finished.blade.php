<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <meta http-equiv="X-UA-Compatible" content="ie=edge" />
        @vite("resources/css/app.css")
        <title>Payment Successful - Wisatix</title>
    </head>
    <body class="relative mx-auto max-w-[640px] bg-[#F8F8F9]">
        <div class="fixed top-0 z-0 h-screen w-full max-w-[640px]">
            <div
                class="absolute z-0 h-[459px] w-full bg-[linear-gradient(180deg,#000000_12.61%,rgba(0,0,0,0)_70.74%)]"
            ></div>

            <img
                src="{{ Storage::url($bookingTransaction->ticket->thumbnail) }}"
                alt="Ticket background"
                class="h-full w-full object-cover"
            />
        </div>

        <header
            class="relative mt-[60px] flex w-full items-center justify-center px-4"
        >
            <h1 class="w-full text-center text-lg font-bold text-white">
                Success Booking
            </h1>
        </header>

        <main
            class="relative mb-5 mt-5 flex w-full flex-1 items-center justify-center overflow-x-hidden p-4"
        >
            <section
                class="flex h-fit w-full max-w-[361px] flex-col gap-6 rounded-[30px] bg-white p-5"
            >
                <img
                    src="{{ asset("assets/icons/ticket-star.svg") }}"
                    alt="Ticket icon"
                    class="mx-auto h-20 w-20"
                />

                <h2 class="text-center text-2xl font-bold">
                    Booking Finished,
                    <br />
                    Well Done! 🤩
                </h2>

                <div
                    id="booking-id-container"
                    class="relative flex w-full cursor-pointer items-center gap-4 rounded-full bg-[#F8F8F9] px-4 py-3 transition-all duration-300 hover:ring-1 hover:ring-[#F97316]"
                >
                    <img
                        src="{{ asset("assets/icons/receipt-text.svg") }}"
                        class="flex h-8 w-8 shrink-0"
                        alt="icon"
                    />

                    <p>
                        Booking ID
                        <span id="booking-id" class="font-bold text-[#07B704]">
                            {{ $bookingTransaction->booking_trx_id }}
                        </span>
                    </p>

                    <span
                        id="flash-message"
                        class="absolute -top-[25px] left-1/2 hidden w-max -translate-x-1/2 transform rounded-full bg-[#F8F8F9] px-4 py-3 text-xs font-semibold text-[#13181D] shadow"
                    >
                        Booking ID copied!
                    </span>
                </div>

                <p class="text-center">
                    We will check the payment and update the status to your
                    email address
                </p>

                <div class="flex flex-col gap-3">
                    <a
                        href="{{ route("front.index") }}"
                        class="w-full rounded-full bg-[#F97316] p-[14px_20px] text-center font-bold text-white"
                    >
                        Explore More Tickets
                    </a>

                    <a
                        href="{{ route("front.check-booking") }}"
                        class="w-full rounded-full bg-[#13181D] p-[14px_20px] text-center font-bold text-white"
                    >
                        Check My Booking
                    </a>
                </div>
            </section>
        </main>

        @vite("resources/js/front/bookingFinished.js")
    </body>
</html>
