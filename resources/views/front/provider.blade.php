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

        <x-header
            :title="'Provider'"
            :backRoute="route('front.index')"
            :pattern="true"
        />

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
                        <x-ticket-card
                            :thumbnail="$providerTicket->thumbnail"
                            :name="$providerTicket->name"
                            :providerName="$providerTicket->provider->name"
                            :price="$providerTicket->price"
                            :rating="$providerTicket->rating"
                        />
                    </a>
                @empty
                    <p>Tickets not yet available</p>
                @endforelse
            </section>
        </main>
    </body>
</html>
