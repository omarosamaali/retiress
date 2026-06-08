@if ($showMemberHeaderTools ?? false)
@php
    $card   = $membershipCardPayload ?? [];
    $status = $card['status'] ?? ['label' => '', 'badge_class' => ''];
@endphp

<div class="mcard-sheet" id="membershipCardSheet" aria-hidden="true">
    <div class="mcard-sheet__backdrop" id="membershipCardBackdrop"></div>

    <div class="mcard-sheet__dialog">
        <button type="button" class="mcard-sheet__close" id="closeMembershipCard" aria-label="{{ __('app.close') }}">
            <i class="fa-solid fa-xmark"></i>
        </button>
        <p class="mcard-sheet__hint">{{ __('app.tap_to_flip_card') }}</p>

        <div class="mcard-flip" id="membershipFlipCard">
            <div class="mcard-flip__inner">

                {{-- ── FRONT ── --}}
                <div class="mcard-flip__face mcard-flip__face--front">
                    <img src="{{ asset('assets/card-f.png') }}" class="mcard-flip__bg" alt="">

                    {{-- Status badge (corner) --}}
                    @if (!empty($status['label']))
                        <span class="mci-status-badge membership-status-badge {{ $status['badge_class'] ?? '' }}">
                            {{ $status['label'] }}
                        </span>
                    @endif

                    {{-- Photo: top-right --}}
                    <div class="mci-photo-box">
                        <img
                            src="{{ !empty($card['photo_url']) ? $card['photo_url'] : asset('assets/images/default_user.jpg') }}"
                            class="mci-photo-img"
                            alt=""
                            onerror="this.onerror=null;this.src='{{ asset('assets/images/default_user.jpg') }}';"
                        >
                    </div>

                    {{-- Membership number: below photo --}}
                    <div class="mci-number">
                        <div class="mci-number__lbl">{{ __('app.membership_number') }}</div>
                        <div class="mci-number__val">{{ $card['membership_number'] ?? '—' }}</div>
                    </div>

                    {{-- Separator 1 --}}
                    <div class="mci-sep"></div>

                    {{-- Name row --}}
                    <div class="mci-row mci-row--name">
                        <span class="mci-row__lbl" style="position: relative;right: 50px;">{{ __('app.full_name') }} :</span>
                        <span class="mci-row__val">{{ $card['full_name'] ?? '—' }}</span>
                    </div>

                    {{-- Job row --}}
                    <div class="mci-row mci-row--job">
                        <span class="mci-row__lbl" style="position: relative;right: 50px;">{{ __('app.job_title') }} :</span>
                        <span class="mci-row__val" style="right: 22px;
    position: relative;">
                            {{ trim(($card['job_title'] ?? '') . (($card['employer'] ?? '') ? ' — ' . $card['employer'] : '')) ?: '—' }}
                        </span>
                    </div>

                    {{-- Separator 2 --}}
                    <div class="mci-sep mci-sep--2"></div>

                    {{-- Dates --}}
                    <div class="mci-dates">
                        <div class="mci-date-group" style="position: relative;right: 50px;">
                            <span class="mci-date__lbl">{{ __('app.issue_date') }} :</span>
                            <span class="mci-date__val">{{ $card['issue_date'] ?? '—' }}</span>
                        </div>
                        <div class="mci-date-group" style="right: -108px;
    position: relative;">
                            <span class="mci-date__lbl">{{ __('app.membership_expiry') }} :</span>
                            <span class="mci-date__val">{{ $card['expiration_date'] ?? '—' }}</span>
                        </div>
                    </div>

                </div>

                {{-- ── BACK ── --}}
                <div class="mcard-flip__face mcard-flip__face--back">
                    <img src="{{ asset('assets/card-b.png') }}" class="mcard-flip__bg" alt="">
                </div>

            </div>
        </div>
    </div>
</div>
@endif
