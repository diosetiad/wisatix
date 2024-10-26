<article
    class="relative flex h-[220px] w-[345px] shrink-0 items-end overflow-hidden rounded-[30px] bg-[#D9D9D9]"
>
    <img
        src="{{ Storage::url($thumbnail) }}"
        alt="Popular ticket thumbnail"
        class="absolute h-full w-full object-cover"
    />

    <div
        class="mx-4 mb-4 flex h-fit w-[345px] items-center justify-between overflow-hidden rounded-[15px] border border-white/40 bg-[#94959966] p-[8px_10px] backdrop-blur-sm"
    >
        <div class="max-w-[75%] text-white">
            <h2 class="truncate font-bold">
                {{ $name }}
            </h2>

            <span class="text-sm">
                {{ $categoryName }}
            </span>
        </div>

        <div
            class="flex shrink-0 items-center gap-0.5 rounded-full bg-white p-[6px_8px]"
        >
            <img
                src="{{ asset("assets/icons/Star 1.svg") }}"
                alt="Star rating icon"
                class="h-4 w-4"
            />

            <span class="mt-0.5 text-xs font-semibold">{{ $rating }}/5</span>
        </div>
    </div>
</article>
