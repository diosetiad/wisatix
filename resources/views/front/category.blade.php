<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <meta http-equiv="X-UA-Compatible" content="ie=edge" />
        @vite("resources/css/app.css")
        <title>{{ $category->name }} - Wisatix</title>
    </head>
    <body class="relative mx-auto max-w-[640px] bg-[#F8F8F9]">
        <div
            class="absolute top-0 h-[430px] w-full rounded-b-[50px] bg-[#13181D]"
        ></div>

        <x-header
            :title="'Category'"
            :backRoute="route('front.index')"
            :pattern="true"
        />

        <main
            class="relative mt-[30px] flex w-full flex-col gap-[30px] overflow-x-hidden px-4"
        >
            <section class="flex flex-col gap-2 text-white">
                <div class="flex items-center gap-[6px]">
                    <img
                        src="{{ Storage::url($category->icon_white) }}"
                        alt="Category icon"
                        class="h-[22px] w-[22px]"
                    />

                    <span class="text-sm font-semibold">
                        {{ $category->name }}
                    </span>
                </div>

                <p class="text-xl font-bold">
                    Browse
                    <span class="text-[#F97316]">
                        {{ $category->tickets->count() }}
                    </span>
                    Places
                    <br />
                    Available Worth to Visit
                </p>
            </section>

            <section class="flex flex-col gap-3 pb-10">
                @forelse ($category->tickets as $categoryTicket)
                    <a
                        href="{{ route("front.details", $categoryTicket->slug) }}"
                        aria-label="View details ticket"
                    >
                        <x-ticket-card
                            :thumbnail="$categoryTicket->thumbnail"
                            :name="$categoryTicket->name"
                            :providerName="$categoryTicket->provider->name"
                            :price="$categoryTicket->price"
                            :rating="$categoryTicket->rating"
                        />
                    </a>
                @empty
                    <p>Tickets not yet available</p>
                @endforelse
            </section>
        </main>
    </body>
</html>
