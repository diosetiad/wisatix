<header
    class="relative mt-[60px] flex w-full items-center justify-between px-4"
>
    <a href="{{ $backRoute }}" aria-label="Back route">
        <img
            src="{{ asset("assets/icons/back.svg") }}"
            alt="Back icon"
            class="h-12 w-12"
        />
    </a>

    <h1 class="text-lg font-bold text-white">{{ $title }}</h1>

    @if (isset($pattern) && $pattern)
        <img
            src="{{ asset("assets/icons/Ellipse 3.svg") }}"
            alt="Pattern"
            class="absolute left-1/2 -translate-x-1/2 transform"
        />
    @endif

    <a href="#" aria-label="View your favorites">
        <img
            src="{{ asset("assets/icons/heart.svg") }}"
            alt="Favorites icon"
            class="h-12 w-12"
        />
    </a>
</header>
