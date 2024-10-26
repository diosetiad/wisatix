<article
    class="relative flex h-[200px] w-[170px] shrink-0 items-end overflow-hidden rounded-[30px] bg-[#D9D9D9]"
>
    <img
        src="{{ Storage::url($photo) }}"
        alt="Provider thumbnail"
        class="absolute h-full w-full object-cover"
    />

    <div
        class="mx-[10px] mb-[10px] h-fit w-full overflow-hidden rounded-[15px] border border-white/40 bg-[#94959966] p-[8px_10px] text-white backdrop-blur-sm"
    >
        <h2 class="truncate font-bold">
            {{ $name }}
        </h2>

        <span class="text-sm">
            {{ $tickets }}
            Places
        </span>
    </div>
</article>
