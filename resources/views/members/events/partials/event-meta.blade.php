@php
    $startsAt = $event->display_starts_at;
    $endsAt = $event->display_ends_at;
    $dateTimeFormat = 'd/m/Y - h:i A';
    $dateFormat = 'd F Y';
@endphp

<div class="event-meta my-7z8 fs--oox">
    @if ($startsAt)
        <div class="mb-2">
            <i class="fa fa-calendar"></i>
            <strong>{{ __('app.from') }}:</strong>
            {{ $startsAt->translatedFormat($dateTimeFormat) }}
        </div>
    @endif

    @if ($endsAt)
        <div class="mb-2">
            <i class="fa fa-calendar-check"></i>
            <strong>{{ __('app.to') }}:</strong>
            {{ $endsAt->translatedFormat($dateTimeFormat) }}
        </div>
    @elseif ($startsAt)
        <div class="mb-2 text-muted small">
            {{ __('app.event_end_not_set') }}
        </div>
    @endif

    <div class="mb-2">
        <i class="fa-vxc fa-p16 mx-8rj"></i>
        <strong>{{ __('app.price') }}:</strong>
        @if ($event->isFree())
            {{ __('app.free_event') }}
        @else
            {{ number_format((float) $event->price, 2) }} {{ __('app.aed') }}
        @endif
    </div>

    @if ($event->created_at)
        <div class="mb-2 text-muted small">
            <i class="fa fa-clock"></i>
            {{ __('app.publication_date') }}:
            {{ $event->created_at->translatedFormat($dateFormat) }}
        </div>
    @endif
</div>
