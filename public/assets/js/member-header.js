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
    const notifDropdown = document.getElementById('memberNotificationsDropdown');
    const notifClose = document.getElementById('closeMemberNotifications');

    function closeNotifDropdown() {
        if (!notifDropdown) return;
        notifDropdown.hidden = true;
        notifToggle?.setAttribute('aria-expanded', 'false');
    }

    notifToggle?.addEventListener('click', function (e) {
        e.stopPropagation();
        if (!notifDropdown) return;
        const open = notifDropdown.hidden;
        notifDropdown.hidden = !open;
        notifToggle.setAttribute('aria-expanded', open ? 'true' : 'false');
    });

    notifClose?.addEventListener('click', closeNotifDropdown);

    document.addEventListener('click', function (e) {
        if (!e.target.closest('.member-notifications-wrap')) {
            closeNotifDropdown();
        }
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
