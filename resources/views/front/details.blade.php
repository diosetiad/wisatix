<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <meta http-equiv="X-UA-Compatible" content="ie=edge" />
        @vite("resources/css/app.css")
        <title>{{ $ticket->name }} - Wisatix</title>
    </head>

    <body class="relative mx-auto max-w-[640px] bg-white">
        <header
            class="absolute z-10 mt-[60px] flex w-full items-center justify-between px-4"
        >
            <a href="{{ route("front.index") }}" aria-label="Back to index">
                <img
                    src="{{ asset("assets/icons/back.svg") }}"
                    alt="Back icon"
                    class="h-12 w-12"
                />
            </a>

            <a href="#" aria-label="View your favorites">
                <img
                    src="{{ asset("assets/icons/heart.svg") }}"
                    alt="Favorites icon"
                    class="h-12 w-12"
                />
            </a>
        </header>

        <main class="flex w-full flex-col gap-5 overflow-x-hidden">
            <section class="relative mb-[44px] h-[480px]">
                <div class="absolute bottom-0 z-10 w-full p-4 pt-0">
                    <div
                        class="flex h-fit w-full items-center justify-between rounded-[17px] border border-white/40 bg-[#94959966] p-[8px_10px] backdrop-blur-sm"
                    >
                        <div class="text-white">
                            <h1 class="font-bold">
                                {{ $ticket->name }}
                            </h1>

                            <div class="flex items-center gap-[6px]">
                                <img
                                    src="{{ Storage::url($ticket->category->icon) }}"
                                    alt="Category icon"
                                    class="h-[22px] w-[22px]"
                                />
                                <span class="text-sm">
                                    {{ $ticket->category->name }}
                                </span>
                            </div>
                        </div>

                        <div
                            class="flex shrink-0 items-center gap-0.5 rounded-full bg-white p-[6px_8px]"
                        >
                            <img
                                src="{{ asset("assets/icons/Star 1.svg") }}"
                                alt="Star rating icon"
                                class="h-4 w-4"
                            />

                            <span class="mt-0.5 text-xs font-semibold">
                                {{ $ticket->rating }}/5
                            </span>
                        </div>
                    </div>
                </div>

                <div class="swiper w-full overflow-hidden">
                    <ul class="swiper-wrapper cursor-pointer">
                        <li class="swiper-slide">
                            <div
                                class="relative flex h-[480px] w-full shrink-0 items-center overflow-hidden bg-[#13181D]"
                            >
                                <img
                                    src="{{ Storage::url($ticket->thumbnail) }}"
                                    alt="Ticket thumbnail"
                                    class="absolute h-full w-full object-cover"
                                />
                            </div>
                        </li>

                        @forelse ($ticket->photos as $ticketPhoto)
                            <li class="swiper-slide">
                                <div
                                    class="relative flex h-[480px] w-full shrink-0 items-end overflow-hidden bg-[#13181D]"
                                >
                                    <img
                                        src="{{ Storage::url($ticketPhoto->photo) }}"
                                        alt="Ticket thumbnail"
                                        class="absolute h-full w-full object-cover"
                                    />
                                </div>
                            </li>
                        @empty
                            <p>Ticket thumbnail not yet available</p>
                        @endforelse

                        @if ($ticket->path_video)
                            <li class="swiper-slide">
                                <div
                                    class="relative flex h-[480px] w-full shrink-0 items-center overflow-hidden bg-[#13181D]"
                                >
                                    <div
                                        id="playBtn"
                                        class="absolute z-10 h-full w-full bg-transparent"
                                    ></div>

                                    <div
                                        class="plyr__video-embed"
                                        id="player"
                                        style="width: 100%; height: 100%"
                                    >
                                        <iframe
                                            src="https://www.youtube.com/embed/{{ $ticket->path_video }}?origin=https://plyr.io&amp;iv_load_policy=3&amp;modestbranding=1&amp;playsinline=1&amp;showinfo=0&amp;rel=0&amp;enablejsapi=1"
                                            allowfullscreen
                                            allowtransparency
                                            allow="autoplay"
                                        ></iframe>
                                    </div>
                                </div>
                            </li>
                        @endif
                    </ul>

                    <div
                        class="swiper-pagination !relative !bottom-auto flex items-center justify-center gap-[6px] py-5"
                    ></div>
                </div>
            </section>

            <section class="flex flex-col gap-[6px] px-4 text-sm">
                <h2 class="font-bold">Get to Know</h2>

                <p>
                    {!! $ticket->about !!}
                </p>
            </section>

            <section class="flex flex-col gap-[6px] px-4 text-sm">
                <h2 class="font-bold">Time</h2>

                <ul class="grid grid-cols-2 gap-4">
                    @include("components.time-card")
                </ul>
            </section>

            <section class="flex flex-col gap-[6px] px-4 text-sm">
                <h2 class="font-bold">Get to Know</h2>

                <ul class="grid grid-cols-3 gap-3">
                    @include("components.benefit-card")
                </ul>
            </section>

            <section class="flex flex-col gap-[6px] px-4 text-sm">
                <h2 class="font-bold">Management</h2>

                <div
                    class="flex items-center justify-between rounded-3xl bg-[#F8F8F9] p-[10px] pr-[14px]"
                >
                    <div class="flex items-center gap-[14px]">
                        <div
                            class="h-[60px] w-[60px] overflow-hidden rounded-[20px]"
                        >
                            <img
                                src="{{ Storage::url($ticket->provider->photo) }}"
                                alt="Provider image"
                                class="h-full w-full object-cover"
                            />
                        </div>

                        <div>
                            <h3 class="text-lg font-bold">
                                {{ $ticket->provider->name }}
                            </h3>
                            <span>
                                {{ $ticket->provider->tickets->count() }}
                                Places
                            </span>
                        </div>
                    </div>

                    <a href="#" aria-label="Call provider">
                        <img
                            src="{{ asset("assets/icons/call-orange.svg") }}"
                            alt="Call icon"
                            class="h-10 w-10"
                        />
                    </a>
                </div>
            </section>

            <section
                class="mb-[98px] flex flex-col gap-[10px] px-4 pb-5 text-sm"
            >
                <h2 class="font-bold">Map & Address</h2>

                <div class="h-[200px] w-full overflow-hidden">
                    <iframe
                        class="h-full w-full"
                        frameborder="0"
                        src="https://www.google.com/maps/embed/v1/place?q={{ $ticket->address }}&key=AIzaSyBFw0Qbyq9zTFTd-tUY6dZWTgaQzuU17R8"
                    ></iframe>
                </div>

                <p>{{ $ticket->address }}</p>
            </section>
        </main>

        <nav
            class="fixed bottom-0 z-10 flex w-full max-w-[640px] items-center justify-between bg-white px-4 py-5"
        >
            <div>
                <span class="text-[22px] font-bold">
                    Rp
                    {{ number_format($ticket->price, 0, ",", ".") }}
                </span>

                <span class="text-sm text-[#70758F]">/person</span>
            </div>

            <a href="{{ route("front.booking", $ticket->slug) }}">
                <div
                    class="flex w-fit items-center gap-4 rounded-full bg-[#13181D] p-1 pl-5"
                >
                    <span class="font-bold text-white">Book Now</span>

                    <img
                        src="{{ asset("assets/icons/coupon.svg") }}"
                        alt="Booking icon"
                    />
                </div>
            </a>
        </nav>

        @vite("resources/js/front/details.js")
    </body>
</html>
