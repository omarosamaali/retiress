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

                    @if (!empty($status['label']))
                        <span class="mci-status-badge membership-status-badge {{ $status['badge_class'] ?? '' }}">
                            {{ $status['label'] }}
                        </span>
                    @endif

                    {{-- Right panel: photo + all data stacked --}}
                    <div class="mci-panel">

                        <div class="mci-panel__photo">
                            <img
                                src="{{ !empty($card['photo_url']) ? $card['photo_url'] : asset('assets/images/default_user.jpg') }}"
                                class="mci-photo-img"
                                alt=""
                                onerror="this.onerror=null;this.src='{{ asset('assets/images/default_user.jpg') }}';"
                            >
                        </div>

                        <div class="mci-panel__num">
                            <span class="mci-panel__num-lbl">{{ __('app.membership_number') }}</span>
                            <span class="mci-panel__num-val">{{ $card['membership_number'] ?? '—' }}</span>
                        </div>

                        <div class="mci-panel__sep"></div>

                        <div class="mci-panel__field">
                            <span class="mci-panel__lbl">{{ __('app.full_name') }} :</span>
                            <span class="mci-panel__val">{{ $card['full_name'] ?? '—' }}</span>
                        </div>

                        <div class="mci-panel__field">
                            <span class="mci-panel__lbl">{{ __('app.job_title') }} :</span>
                            <span class="mci-panel__val">{{ trim(($card['job_title'] ?? '') . ($card['employer'] ? ' — ' . $card['employer'] : '')) ?: '—' }}</span>
                        </div>

                        <div class="mci-panel__sep"></div>

                        <div class="mci-panel__field">
                            <span class="mci-panel__lbl">{{ __('app.issue_date') }} :</span>
                            <span class="mci-panel__val">{{ $card['issue_date'] ?? '—' }}</span>
                        </div>

                        <div class="mci-panel__field">
                            <span class="mci-panel__lbl">{{ __('app.membership_expiry') }} :</span>
                            <span class="mci-panel__val">{{ $card['expiration_date'] ?? '—' }}</span>
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
