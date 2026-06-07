@php
    $startsAt = $event->display_starts_at;
    $endsAt   = $event->display_ends_at;
    $dtFmt    = 'd/m/Y - h:i A';
    $dFmt     = 'd F Y';
@endphp

<div style="display:flex;flex-direction:column;gap:10px;margin:14px 0;direction:rtl;">

    @if($startsAt)
    <div style="display:flex;align-items:center;gap:10px;background:#f8fafc;border-radius:8px;padding:10px 14px;">
        <span style="width:36px;height:36px;background:#e0f2fe;border-radius:8px;display:flex;align-items:center;justify-content:center;flex-shrink:0;">
            <i class="fa-regular fa-calendar" style="color:#0284c7;font-size:1rem;"></i>
        </span>
        <div>
            <div style="font-size:.72rem;color:#6b7280;font-weight:600;margin-bottom:1px;">{{ __('app.from') }}</div>
            <div style="font-size:.92rem;font-weight:700;color:#1e293b;">{{ $startsAt->translatedFormat($dtFmt) }}</div>
        </div>
    </div>
    @endif

    @if($endsAt)
    <div style="display:flex;align-items:center;gap:10px;background:#f8fafc;border-radius:8px;padding:10px 14px;">
        <span style="width:36px;height:36px;background:#dcfce7;border-radius:8px;display:flex;align-items:center;justify-content:center;flex-shrink:0;">
            <i class="fa-regular fa-calendar-check" style="color:#16a34a;font-size:1rem;"></i>
        </span>
        <div>
            <div style="font-size:.72rem;color:#6b7280;font-weight:600;margin-bottom:1px;">{{ __('app.to') }}</div>
            <div style="font-size:.92rem;font-weight:700;color:#1e293b;">{{ $endsAt->translatedFormat($dtFmt) }}</div>
        </div>
    </div>
    @endif

    <div style="display:flex;align-items:center;gap:10px;background:#f8fafc;border-radius:8px;padding:10px 14px;">
        <span style="width:36px;height:36px;background:#fef9c3;border-radius:8px;display:flex;align-items:center;justify-content:center;flex-shrink:0;">
            <i class="fa-solid fa-tag" style="color:#a16207;font-size:1rem;"></i>
        </span>
        <div>
            <div style="font-size:.72rem;color:#6b7280;font-weight:600;margin-bottom:1px;">{{ __('app.price') }}</div>
            <div style="font-size:.92rem;font-weight:700;color:#1e293b;">
                @if($event->isFree())
                    <span style="color:#16a34a;">{{ __('app.free_event') }}</span>
                @else
                    {{ number_format((float)$event->price, 2) }} {{ __('app.aed') }}
                @endif
            </div>
        </div>
    </div>

    @if($event->created_at)
    <div style="display:flex;align-items:center;gap:10px;background:#f8fafc;border-radius:8px;padding:10px 14px;">
        <span style="width:36px;height:36px;background:#f3e8ff;border-radius:8px;display:flex;align-items:center;justify-content:center;flex-shrink:0;">
            <i class="fa-regular fa-clock" style="color:#7c3aed;font-size:1rem;"></i>
        </span>
        <div>
            <div style="font-size:.72rem;color:#6b7280;font-weight:600;margin-bottom:1px;">{{ __('app.publication_date') }}</div>
            <div style="font-size:.92rem;font-weight:700;color:#1e293b;">{{ $event->created_at->translatedFormat($dFmt) }}</div>
        </div>
    </div>
    @endif

</div>
