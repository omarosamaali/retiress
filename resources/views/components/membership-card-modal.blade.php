@if ($showMemberHeaderTools ?? false)
    @php
        $card = $membershipCardPayload ?? [];
        $status = $card['status'] ?? ['label' => '', 'badge_class' => ''];
    @endphp
    <div class="membership-sheet" id="membershipCardSheet" aria-hidden="true">
        <div class="membership-sheet__backdrop" id="membershipCardBackdrop"></div>
        <div class="membership-sheet__panel" role="dialog" aria-labelledby="membershipCardTitle">
            <button type="button" class="membership-sheet__close" id="closeMembershipCard" aria-label="{{ __('app.close') }}">×</button>
            <h3 id="membershipCardTitle" class="membership-sheet__title">{{ __('app.membership_card') }}</h3>

            <div class="flip-card" id="membershipFlipCard">
                <div class="flip-card__inner" id="membershipFlipInner">
                    <div class="flip-card__face flip-card__face--front">
                        <div class="flip-card__front-bg" style="background-image: url('{{ asset('assets/f1.png') }}');"></div>
                        <span class="membership-status-badge {{ $status['badge_class'] ?? '' }}">{{ $status['label'] ?? '' }}</span>
                        <p class="flip-card__tap-hint">{{ __('app.tap_to_flip_card') }}</p>
                    </div>
                    <div class="flip-card__face flip-card__face--back">
                        @if ($card['show_details'] ?? false)
                            <div class="flip-card__back-content">
                                @if (! empty($card['photo_url']))
                                    <img src="{{ $card['photo_url'] }}" alt="" class="flip-card__photo">
                                @endif
                                <h4 class="flip-card__name">{{ $card['full_name'] }}</h4>
                                @if (! empty($card['job_title']) || ! empty($card['employer']))
                                    <p class="flip-card__job">
                                        {{ $card['job_title'] }}
                                        @if (! empty($card['employer']))
                                            — {{ $card['employer'] }}
                                        @endif
                                    </p>
                                @endif
                                <ul class="flip-card__details list-unstyled mb-0">
                                    <li><strong>{{ __('app.membership_number') }}:</strong> {{ $card['membership_number'] ?? '—' }}</li>
                                    <li><strong>{{ __('app.membership_expiry') }}:</strong> {{ $card['expiration_date'] ?? '—' }}</li>
                                </ul>
                                <span class="membership-status-badge {{ $status['badge_class'] ?? '' }}">{{ $status['label'] ?? '' }}</span>
                            </div>
                        @else
                            <div class="flip-card__back-content flip-card__back-content--inactive">
                                <p class="mb-3">{{ $status['label'] ?? __('app.membership_not_active') }}</p>
                                <a href="{{ $card['renew_url'] ?? route('members.my-membership') }}" class="btn btn-primary btn-sm">
                                    {{ __('app.renewal') }}
                                </a>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endif
