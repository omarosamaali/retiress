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

    // Move portals to body to escape header's overflow:hidden
    ['memberNotificationsDropdown', 'membershipCardSheet'].forEach(function (id) {
        const el = document.getElementById(id);
        if (el && el.parentNode !== document.body) {
            document.body.appendChild(el);
        }
    });

    // ── Membership Card ─────────────────────────────────────────────────────
    const sheet     = document.getElementById('membershipCardSheet');
    const openCardBtn = document.getElementById('openMembershipCard');
    const closeCardBtn = document.getElementById('closeMembershipCard');
    const backdrop  = document.getElementById('membershipCardBackdrop');
    const flipCard  = document.getElementById('membershipFlipCard');

    function openSheet() {
        if (!sheet) return;
        sheet.classList.add('is-open');
        sheet.setAttribute('aria-hidden', 'false');
        if (!flipCard) return;
        flipCard.classList.remove('is-flipped');
        setTimeout(function () { flipCard.classList.add('is-flipped'); }, 600);
        setTimeout(function () { flipCard.classList.remove('is-flipped'); }, 1800);
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
        if (e.target.closest('a')) return;
        flipCard.classList.toggle('is-flipped');
    });

    // ── Header Notifications Panel ──────────────────────────────────────────
    const notifToggle   = document.getElementById('toggleMemberNotifications');
    const notifScreen   = document.getElementById('memberNotificationsDropdown');
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
        if (e.key === 'Escape') {
            closeNotifScreen();
            document.querySelector('.notif-detail-overlay')?.remove();
        }
    });

    // ── Click on header notification item → show detail overlay ────────────
    document.querySelectorAll('.notif-screen__item[data-id]').forEach(function (item) {
        item.addEventListener('click', function (e) {
            if (e.target.closest('.notif-screen__dismiss')) return;

            const title = item.dataset.title || item.querySelector('.notif-screen__item-title')?.textContent?.trim() || '';
            const body  = item.dataset.body  || item.querySelector('.notif-screen__item-body')?.textContent?.trim()  || '';
            const time  = item.querySelector('.notif-screen__item-time')?.textContent?.trim() || '';

            const panel = document.querySelector('.notif-screen__panel');
            if (!panel) return;

            panel.querySelector('.notif-detail-overlay')?.remove();

            const overlay = document.createElement('div');
            overlay.className = 'notif-detail-overlay';
            overlay.style.cssText = [
                'position:absolute', 'inset:0', 'background:#fff', 'z-index:20',
                'padding:20px', 'overflow-y:auto', 'display:flex',
                'flex-direction:column', 'gap:14px', 'direction:rtl',
            ].join(';');

            overlay.innerHTML =
                '<div style="display:flex;align-items:flex-start;justify-content:space-between;border-bottom:1px solid #e5e7eb;padding-bottom:12px;gap:8px;">' +
                    '<span style="font-weight:700;font-size:1rem;color:#1e293b;line-height:1.5;">' + title + '</span>' +
                    '<button class="notif-detail-close" style="flex-shrink:0;background:none;border:1.5px solid #e5e7eb;border-radius:6px;cursor:pointer;padding:4px 8px;color:#6b7280;font-size:.85rem;line-height:1;" title="إغلاق">' +
                        '<i class="fa-solid fa-xmark"></i>' +
                    '</button>' +
                '</div>' +
                '<div style="font-size:.9rem;color:#374151;line-height:1.8;white-space:pre-wrap;">' + body + '</div>' +
                '<div style="font-size:.75rem;color:#9ca3af;">' + time + '</div>';

            panel.style.position = 'relative';
            panel.appendChild(overlay);

            overlay.querySelector('.notif-detail-close')?.addEventListener('click', function () {
                overlay.remove();
            });
        });
    });

    // ── Dismiss notification in header dropdown ─────────────────────────────
    document.querySelectorAll('.notif-screen__item .member-notification-dismiss').forEach(function (btn) {
        btn.addEventListener('click', function (e) {
            e.preventDefault();
            e.stopPropagation();
            const url = btn.getAttribute('data-dismiss-url');
            if (!url) return;
            post(url).then(function () {
                btn.closest('.notif-screen__item')?.remove();
                // update header badge
                const badge = document.querySelector('.member-notifications-badge');
                if (badge) {
                    const n = parseInt(badge.textContent) - 1;
                    if (n <= 0) badge.remove();
                    else badge.textContent = n > 99 ? '99+' : n;
                }
            });
        });
    });

    // ── Dismiss notification on panel page → move to "رأيتها" ───────────────
    document.querySelectorAll('.mp-notif-row .member-notification-dismiss').forEach(function (btn) {
        btn.addEventListener('click', function (e) {
            e.preventDefault();
            e.stopPropagation();
            const url = btn.getAttribute('data-dismiss-url');
            if (!url) return;
            const row = btn.closest('.mp-notif-row');
            post(url).then(function () {
                if (!row) return;

                const readBody = document.querySelector('#section-notif-read .mp-card__body');

                if (readBody) {
                    readBody.querySelector('.mp-empty')?.remove();

                    const contentHtml = row.querySelector('.mp-notif-row__content')?.innerHTML || '';
                    const readRow = document.createElement('div');
                    readRow.className = 'mp-notif-row';
                    readRow.style.opacity = '0.7';
                    readRow.innerHTML =
                        '<div class="mp-notif-row__icon"><i class="fa-solid fa-circle-info"></i></div>' +
                        '<div class="mp-notif-row__content">' + contentHtml + '</div>';
                    readBody.prepend(readRow);

                    // update read count badge
                    const readHead = document.querySelector('#section-notif-read .mp-card__head');
                    if (readHead) {
                        let badge = readHead.querySelector('.notif-count-badge');
                        if (badge) {
                            badge.textContent = parseInt(badge.textContent) + 1;
                        } else {
                            badge = document.createElement('span');
                            badge.className = 'notif-count-badge';
                            badge.style.cssText = 'margin-right:auto;background:#e2e8f0;color:#475569;font-size:11px;font-weight:700;padding:2px 8px;border-radius:20px;';
                            badge.textContent = '1';
                            readHead.appendChild(badge);
                        }
                    }
                }

                row.remove();

                // update unread count badge
                const remaining = document.querySelectorAll('#section-notif-unread .mp-notif-row').length;
                const unreadHead = document.querySelector('#section-notif-unread .mp-card__head span:not(.notif-count-badge)');
                const unreadBadge = document.querySelector('#section-notif-unread .mp-card__head span');
                if (unreadBadge) {
                    if (remaining <= 0) unreadBadge.remove();
                    else unreadBadge.textContent = remaining;
                }

                if (remaining <= 0) {
                    const unreadBody = document.querySelector('#section-notif-unread .mp-card__body');
                    if (unreadBody) {
                        unreadBody.innerHTML =
                            '<div class="mp-empty">' +
                            '<i class="fa-regular fa-bell-slash"></i>' +
                            '<span>لا توجد إشعارات</span>' +
                            '</div>';
                    }
                }
            });
        });
    });
})();
