<article
    class="flex w-full items-center justify-between overflow-hidden rounded-3xl bg-white p-[6px] pr-[14px]"
>
    <div class="flex items-center gap-[14px] overflow-hidden">
        <div
            class="flex h-[90px] w-[90px] shrink-0 overflow-hidden rounded-3xl bg-[#D9D9D9]"
        >
            <img
                src="{{ Storage::url($thumbnail) }}"
                class="h-full w-full object-cover"
                alt="Ticket thumbnail"
            />
        </div>

        <div
            class="flex max-w-[60%] flex-col gap-[6px] overflow-hidden font-semibold md:max-w-[80%]"
        >
            <h2 class="truncate">
                {{ $name }}
            </h2>

            <div class="flex items-center gap-1">
                <img
                    src="{{ asset("assets/icons/location.svg") }}"
                    alt="Location icon"
                    class="h-[18px] w-[18px]"
                />
                <span class="text-xs">
                    {{ $providerName }}
                </span>
            </div>

            <span class="text-sm font-bold text-[#F97316]">
                Rp
                {{ number_format($price, 0, ",", ".") }}
            </span>

            @if (isset($showInput) && $showInput)
                <input
                    type="hidden"
                    name="ticket_price"
                    id="ticket-price"
                    value="{{ $price }}"
                />
            @endif
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

        <span class="mt-0.5 text-xs font-semibold text-[#F97316]">
            {{ $rating }}/5
        </span>
    </div>
</article>
