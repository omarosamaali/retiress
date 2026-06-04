(function () {
    function getCsrfToken() {
        const meta = document.querySelector('meta[name="csrf-token"]')?.getAttribute('content');
        if (meta) return meta;
        const match = document.cookie.match(/XSRF-TOKEN=([^;]+)/);
        return match ? decodeURIComponent(match[1]) : '';
    }

    const csrf = getCsrfToken();

    function post(url) {
        return fetch(url, {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': csrf || '',
                'Accept': 'application/json',
                'X-Requested-With': 'XMLHttpRequest',
            },
        });
    }

    const sheet = document.getElementById('membershipCardSheet');
    const openCardBtn = document.getElementById('openMembershipCard');
    const closeCardBtn = document.getElementById('closeMembershipCard');
    const backdrop = document.getElementById('membershipCardBackdrop');
    const flipCard = document.getElementById('membershipFlipCard');

    function openSheet() {
        if (!sheet) return;
        sheet.classList.add('is-open');
        sheet.setAttribute('aria-hidden', 'false');
        if (flipCard) flipCard.classList.remove('is-flipped');
    }

    function closeSheet() {
        if (!sheet) return;
        sheet.classList.remove('is-open');
        sheet.setAttribute('aria-hidden', 'true');
        if (flipCard) flipCard.classList.remove('is-flipped');
    }

    openCardBtn?.addEventListener('click', openSheet);
    closeCardBtn?.addEventListener('click', closeSheet);
    backdrop?.addEventListener('click', closeSheet);

    flipCard?.addEventListener('click', function (e) {
        if (e.target.closest('.flip-card__back-content a')) return;
        flipCard.classList.toggle('is-flipped');
    });

    const notifToggle = document.getElementById('toggleMemberNotifications');
    const notifScreen = document.getElementById('memberNotificationsDropdown');
    const notifBackdrop = document.getElementById('closeMemberNotifications');
    const notifCloseBtn = document.getElementById('closeMemberNotificationsBtn');

    function openNotifScreen() {
        if (!notifScreen) return;
        notifScreen.removeAttribute('hidden');
        notifScreen.setAttribute('aria-hidden', 'false');
        notifToggle?.setAttribute('aria-expanded', 'true');
        document.body.style.overflow = 'hidden';
    }

    function closeNotifScreen() {
        if (!notifScreen) return;
        notifScreen.setAttribute('aria-hidden', 'true');
        notifScreen.setAttribute('hidden', '');
        notifToggle?.setAttribute('aria-expanded', 'false');
        document.body.style.overflow = '';
    }

    notifToggle?.addEventListener('click', function (e) {
        e.stopPropagation();
        const isHidden = notifScreen?.hasAttribute('hidden') || notifScreen?.getAttribute('aria-hidden') === 'true';
        isHidden ? openNotifScreen() : closeNotifScreen();
    });

    notifBackdrop?.addEventListener('click', closeNotifScreen);
    notifCloseBtn?.addEventListener('click', closeNotifScreen);

    document.addEventListener('keydown', function (e) {
        if (e.key === 'Escape') closeNotifScreen();
    });

    document.querySelectorAll('.member-notification-dismiss').forEach(function (btn) {
        btn.addEventListener('click', function (e) {
            e.preventDefault();
            e.stopPropagation();
            const url = btn.getAttribute('data-dismiss-url');
            if (!url) return;
            post(url).then(function () {
                const item = btn.closest('.member-notification-item');
                item?.remove();
            });
        });
    });
})();
