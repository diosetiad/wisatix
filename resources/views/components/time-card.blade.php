@php
    $operationTime = [
        [
            "icon" => "assets/icons/timer.svg",
            "alt" => "Open time icon",
            "label" => "Open Time",
            "time" => $ticket->open_time_at,
        ],
        [
            "icon" => "assets/icons/clock.svg",
            "alt" => "Closed time icon",
            "label" => "Closed Time",
            "time" => $ticket->closed_time_at,
        ],
    ];
@endphp

@foreach ($operationTime as $item)
    <li class="flex items-center gap-4 rounded-3xl bg-[#F8F8F9] p-[14px_16px]">
        <img
            src="{{ asset($item["icon"]) }}"
            alt="{{ $item["alt"] }}"
            class="h-6 w-6"
        />

        <div class="flex flex-col">
            <span>{{ $item["label"] }}</span>

            <span class="text-lg font-bold">
                {{ $item["time"] }}
            </span>
        </div>
    </li>
@endforeach
