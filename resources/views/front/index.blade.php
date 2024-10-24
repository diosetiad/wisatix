<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <meta http-equiv="X-UA-Compatible" content="ie=edge" />
        @vite("resources/css/app.css")
        <title>Wisatix</title>
    </head>

    <body class="mx-auto max-w-[640px] bg-white">
        <header class="mt-[60px] flex w-full items-center justify-between px-4">
            <a href="{{ route("front.index") }}" aria-label="View index">
                <img
                    src="{{ asset("assets/logos/logo.svg") }}"
                    alt="Wisatix logo"
                    class="flex shrink-0"
                />
            </a>

            <a href="#" aria-label="View your favorites">
                <img
                    src="{{ asset("assets/icons/heart-fill.svg") }}"
                    alt="Favorites icon"
                    class="h-12 w-12"
                />
            </a>
        </header>

        <main class="mt-5 flex w-full flex-col gap-5 overflow-x-hidden">
            <section class="flex flex-col gap-3">
                <h1 class="px-4 font-bold">Popular This Year</h1>

                <div class="swiper w-full overflow-hidden">
                    <ul class="swiper-wrapper">
                        @forelse ($popularTickets as $popularTicket)
                            <li class="swiper-slide !w-fit">
                                <a
                                    href="{{ route("front.details", $popularTicket->slug) }}"
                                    aria-label="View details ticket"
                                >
                                    <x-popular-ticket-card
                                        :thumbnail="$popularTicket->thumbnail"
                                        :name="$popularTicket->name"
                                        :categoryName="$popularTicket->category->name"
                                        :rating="$popularTicket->rating"
                                    />
                                </a>
                            </li>
                        @empty
                            <p>Popular tickets not yet available.</p>
                        @endforelse
                    </ul>
                </div>
            </section>

            <section class="flex flex-col gap-3">
                <h1 class="px-4 font-bold">By Categories</h1>

                <div class="swiper w-full overflow-hidden">
                    <ul class="swiper-wrapper">
                        @forelse ($categories as $category)
                            <li class="swiper-slide !w-fit">
                                <a
                                    href="{{ route("front.category", $category->slug) }}"
                                    aria-label="View category"
                                >
                                    <x-category-card
                                        :icon="$category->icon"
                                        :name="$category->name"
                                    />
                                </a>
                            </li>
                        @empty
                            <p>Categories not yet available.</p>
                        @endforelse
                    </ul>
                </div>
            </section>

            <section class="flex flex-col gap-3">
                <h1 class="px-4 font-bold">You Should Visit</h1>

                <div class="swiper w-full overflow-hidden">
                    <ul class="swiper-wrapper">
                        @forelse ($providers as $provider)
                            <li class="swiper-slide !w-fit">
                                <a
                                    href="{{ route("front.provider", $provider->slug) }}"
                                    aria-label="View details provider"
                                >
                                    <x-provider-card
                                        :photo="$provider->photo"
                                        :name="$provider->name"
                                        :tickets="$provider->tickets->count()"
                                    />
                                </a>
                            </li>
                        @empty
                            <p>Providers not yet available.</p>
                        @endforelse
                    </ul>
                </div>
            </section>

            <section
                class="mb-[94px] flex flex-col gap-3 bg-[#F8F8F9] px-4 py-5"
            >
                <h1 class="font-bold">Now Available</h1>

                <ul class="flex flex-col gap-3">
                    @forelse ($newTickets as $newTicket)
                        <li>
                            <a
                                href="{{ route("front.details", $newTicket->slug) }}"
                                aria-label="View details ticket"
                            >
                                <x-ticket-card
                                    :thumbnail="$newTicket->thumbnail"
                                    :name="$newTicket->name"
                                    :providerName="$newTicket->provider->name"
                                    :price="$newTicket->price"
                                    :rating="$newTicket->rating"
                                />
                            </a>
                        </li>
                    @empty
                        <p>Tickets not yet available.</p>
                    @endforelse
                </ul>
            </section>
        </main>

        @include("components.navbar")

        @vite("resources/js/front/index.js")
    </body>
</html>
