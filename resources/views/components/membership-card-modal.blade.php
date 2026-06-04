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
            <div class="mcard-flip__inner" id="membershipFlipInner">

                {{-- ── FRONT ── --}}
                <div class="mcard-flip__face mcard-flip__face--front">
                    <img src="{{ asset('assets/card-f.png') }}" class="mcard-flip__bg" alt="">

                    @if ($card['show_details'] ?? false)
                        {{-- Photo --}}
                        <div class="mcard-photo-wrap">
                            @if (!empty($card['photo_url']))
                                <img src="{{ $card['photo_url'] }}" class="mcard-photo" alt="">
                            @else
                                <div class="mcard-photo mcard-photo--placeholder">
                                    <i class="fa-solid fa-user"></i>
                                </div>
                            @endif
                        </div>

                        {{-- Membership number --}}
                        <div class="mcard-num-wrap">
                            <div class="mcard-num__label">{{ __('app.membership_number') }}</div>
                            <div class="mcard-num__val">{{ $card['membership_number'] ?? '—' }}</div>
                        </div>

                        {{-- Data rows --}}
                        <div class="mcard-data">
                            <div class="mcard-row">
                                <span class="mcard-row__label">{{ __('app.full_name') }} :</span>
                                <span class="mcard-row__val">{{ $card['full_name'] ?? '—' }}</span>
                            </div>
                            <div class="mcard-row">
                                <span class="mcard-row__label">{{ __('app.job_title') }} :</span>
                                <span class="mcard-row__val">
                                    {{ $card['job_title'] ?? '' }}
                                    @if (!empty($card['employer'])) — {{ $card['employer'] }} @endif
                                    @if (empty($card['job_title']) && empty($card['employer'])) — @endif
                                </span>
                            </div>
                        </div>

                        {{-- Dates --}}
                        <div class="mcard-dates">
                            <div class="mcard-date-item">
                                <span class="mcard-date-item__label">{{ __('app.issue_date') }} :</span>
                                <span class="mcard-date-item__val">{{ $card['issue_date'] ?? '—' }}</span>
                            </div>
                            <div class="mcard-date-item">
                                <span class="mcard-date-item__label">{{ __('app.membership_expiry') }} :</span>
                                <span class="mcard-date-item__val">{{ $card['expiration_date'] ?? '—' }}</span>
                            </div>
                        </div>

                    @else
                        <div class="mcard-inactive">
                            <span class="membership-status-badge {{ $status['badge_class'] ?? '' }}">{{ $status['label'] ?? '' }}</span>
                            <a href="{{ $card['renew_url'] ?? route('members.my-membership') }}" class="mcard-renew-btn">
                                {{ __('app.renewal') }}
                            </a>
                        </div>
                    @endif
                </div>

                {{-- ── BACK ── --}}
                <div class="mcard-flip__face mcard-flip__face--back">
                    <img src="{{ asset('assets/card-b.png') }}" class="mcard-flip__bg" alt="">
                </div>

            </div>
        </div>{{-- /mcard-flip --}}
    </div>
</div>
@endif
