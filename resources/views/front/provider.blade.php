<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <meta http-equiv="X-UA-Compatible" content="ie=edge" />
        @vite("resources/css/app.css")
        <title>{{ $provider->name }} - Wisatix</title>
    </head>
    <body class="relative mx-auto max-w-[640px] bg-[#F8F8F9]">
        <div
            class="absolute top-0 h-[200px] w-full rounded-b-[50px] bg-[#13181D]"
        ></div>

        <header
            class="relative mt-[60px] flex w-full items-center justify-between px-4"
        >
            <a href="{{ route("front.index") }}" aria-label="Back to index">
                <img
                    src="{{ asset("assets/icons/back.svg") }}"
                    alt="Back icon"
                    class="h-12 w-12"
                />
            </a>

            <h1 class="w-full text-center text-lg font-bold text-white">
                Provider
            </h1>

            <img
                src="{{ asset("assets/icons/Ellipse 3.svg") }}"
                alt="Pattern"
                class="absolute left-1/2 -translate-x-1/2 transform"
            />

            <a href="#" aria-label="View your favorites">
                <img
                    src="{{ asset("assets/icons/heart.svg") }}"
                    alt="Favorites icon"
                    class="h-12 w-12"
                />
            </a>
        </header>

        <main
            class="relative mt-[30px] flex w-full flex-col gap-[30px] overflow-x-hidden px-4"
        >
            <section class="flex flex-col items-center gap-5 text-center">
                <div
                    class="h-[120px] w-[120px] overflow-hidden rounded-[50px] bg-[#D9D9D9]"
                >
                    <img
                        src="{{ Storage::url($provider->photo) }}"
                        alt="Provider thumbnail"
                        class="h-full w-full object-cover"
                    />
                </div>
                <p class="text-xl font-bold">
                    <span class="text-[#F97316]">
                        {{ $provider->tickets->count() }}
                    </span>
                    Things to Do
                    <br />
                    in {{ $provider->name }}
                </p>
            </section>

            <section class="flex flex-col gap-3 pb-10">
                @forelse ($provider->tickets as $providerTicket)
                    <a
                        href="{{ route("front.details", $providerTicket->slug) }}"
                        aria-label="View details ticket"
                    >
                        <article
                            class="flex w-full items-center justify-between overflow-hidden rounded-3xl bg-white p-[6px] pr-[14px]"
                        >
                            <div
                                class="flex items-center gap-[14px] overflow-hidden"
                            >
                                <div
                                    class="flex h-[90px] w-[90px] shrink-0 overflow-hidden rounded-3xl bg-[#D9D9D9]"
                                >
                                    <img
                                        src="{{ Storage::url($providerTicket->thumbnail) }}"
                                        class="h-full w-full object-cover"
                                        alt="Ticket thumbnail"
                                    />
                                </div>

                                <div
                                    class="flex max-w-[60%] flex-col gap-[6px] overflow-hidden font-semibold md:max-w-[80%]"
                                >
                                    <h2 class="truncate">
                                        {{ $providerTicket->name }}
                                    </h2>

                                    <div class="flex items-center gap-1">
                                        <img
                                            src="{{ asset("assets/icons/location.svg") }}"
                                            alt="Location icon"
                                            class="h-[18px] w-[18px]"
                                        />
                                        <span class="text-xs">
                                            {{ $providerTicket->provider->name }}
                                        </span>
                                    </div>

                                    <span
                                        class="text-sm font-bold text-[#F97316]"
                                    >
                                        Rp
                                        {{ number_format($providerTicket->price, 0, ",", ".") }}
                                    </span>
                                </div>
                            </div>

                            <div
                                class="flex shrink-0 items-center gap-0.5 rounded-full bg-[#FFE5D3] p-[6px_8px]"
                            >
                                <img
                                    src="{{ asset("assets/icons/Star 1.svg") }}"
                                    alt="Star rating icon"
                                    class="h-4 w-4"
                                />

                                <span
                                    class="mt-0.5 text-xs font-semibold text-[#F97316]"
                                >
                                    {{ $providerTicket->rating }}/5
                                </span>
                            </div>
                        </article>
                    </a>
                @empty
                    <p>Tickets not yet available</p>
                @endforelse
            </section>
        </main>
    </body>
</html>
