@php
    $benefits = [
        [
            "icon" => "assets/icons/security-card.svg",
            "alt" => "Security icon",
            "label" => "Security",
            "desc" => "24/7 Support",
        ],
        [
            "icon" => "assets/icons/hospital.svg",
            "alt" => "Insurance icon",
            "label" => "Insurance",
            "desc" => "Available",
        ],
        [
            "icon" => "assets/icons/lovely.svg",
            "alt" => "Comfort icon",
            "label" => "Comfort",
            "desc" => "Easy Refund",
        ],
    ];
@endphp

@foreach ($benefits as $item)
    <li
        class="flex flex-col items-center gap-3 rounded-3xl bg-[#13181D] p-[14px_16px] text-center"
    >
        <img
            src="{{ asset($item["icon"]) }}"
            alt="{{ $item["alt"] }}"
            class="h-9 w-9"
        />

        <div class="flex flex-col gap-1 text-white">
            <span class="font-bold">
                {{ $item["label"] }}
            </span>

            <span class="text-xs">
                {{ $item["desc"] }}
            </span>
        </div>
    </li>
@endforeach
