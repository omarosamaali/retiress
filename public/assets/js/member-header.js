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
            credentials: 'same-origin',
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
    const sheet       = document.getElementById('membershipCardSheet');
    const openCardBtn = document.getElementById('openMembershipCard');
    const closeCardBtn= document.getElementById('closeMembershipCard');
    const backdrop    = document.getElementById('membershipCardBackdrop');
    const flipCard    = document.getElementById('membershipFlipCard');

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

    // ── Show notification detail overlay + mark as read ────────────────────
    function showNotifDetail(item) {
        const title = item.dataset.title || item.querySelector('.notif-screen__item-title')?.textContent?.trim() || '';
        const body  = item.dataset.body  || item.querySelector('.notif-screen__item-body')?.textContent?.trim()  || '';
        const time  = item.querySelector('.notif-screen__item-time')?.textContent?.trim() || '';
        const id    = item.dataset.id;

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
                '<button class="notif-detail-close" style="flex-shrink:0;background:#f1f5f9;border:1.5px solid #e5e7eb;border-radius:6px;cursor:pointer;padding:4px 10px;color:#6b7280;font-size:.85rem;line-height:1;" title="إغلاق">' +
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

        // Mark as read
        if (id) {
            const readUrl = '/members/notifications/' + id + '/read';
            post(readUrl).then(function () {
                item.style.opacity = '0.65';
                item.dataset.read = '1';
                updateBadge(Math.max(0, currentBadge() - 1));
            }).catch(function () {});
        }
    }

    // ── Attach click handlers to notification items (supports dynamic items) ─
    function bindNotifItem(item) {
        if (item.dataset.bound) return;
        item.dataset.bound = '1';

        item.addEventListener('click', function (e) {
            if (e.target.closest('.notif-screen__dismiss')) return;
            showNotifDetail(item);
        });
    }

    function bindAllNotifItems() {
        document.querySelectorAll('.notif-screen__item[data-id]').forEach(bindNotifItem);
    }

    bindAllNotifItems();

    // ── Dismiss in header panel ─────────────────────────────────────────────
    function bindDismissBtn(btn) {
        if (btn.dataset.bound) return;
        btn.dataset.bound = '1';

        btn.addEventListener('click', function (e) {
            e.preventDefault();
            e.stopPropagation();
            const url = btn.getAttribute('data-dismiss-url');
            if (!url) return;

            btn.disabled = true;
            post(url).then(function () {
                const item = btn.closest('.notif-screen__item');
                if (item) {
                    item.style.transition = 'opacity .2s,transform .2s';
                    item.style.opacity = '0';
                    item.style.transform = 'translateX(20px)';
                    setTimeout(function () { item.remove(); }, 200);
                }
                updateBadge(Math.max(0, currentBadge() - 1));
            }).catch(function () { btn.disabled = false; });
        });
    }

    function bindAllDismissBtns() {
        document.querySelectorAll('.notif-screen__item .notif-screen__dismiss').forEach(bindDismissBtn);
    }

    bindAllDismissBtns();

    // ── Dismiss on member panel page ────────────────────────────────────────
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

                const remaining = document.querySelectorAll('#section-notif-unread .mp-notif-row').length;
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

    // ── Toast ────────────────────────────────────────────────────────────────
    var toastContainer = document.createElement('div');
    toastContainer.id = 'notif-toast-container';
    toastContainer.style.cssText = [
        'position:fixed', 'top:90px', 'right:20px', 'z-index:99999',
        'display:flex', 'flex-direction:column', 'gap:10px',
        'max-width:320px', 'width:calc(100vw - 40px)', 'pointer-events:none',
    ].join(';');
    document.body.appendChild(toastContainer);

    var logoUrl = (function () {
        var scripts = document.getElementsByTagName('script');
        for (var i = 0; i < scripts.length; i++) {
            var src = scripts[i].src || '';
            var m = src.match(/(https?:\/\/[^/]+)/);
            if (m) return m[1] + '/assets/images/new-logo.png';
        }
        return '/assets/images/new-logo.png';
    })();

    function showToast(title, body, id) {
        var toast = document.createElement('div');
        toast.style.cssText = [
            'background:#fff', 'border-radius:12px',
            'box-shadow:0 4px 24px rgba(0,0,0,.2)', 'padding:12px 14px',
            'direction:rtl', 'text-align:right', 'pointer-events:all',
            'border-right:4px solid #b68a35',
            'animation:toastIn .3s ease',
            'font-family:"Cairo",sans-serif',
            'position:relative', 'overflow:hidden',
            'cursor:pointer',
        ].join(';');

        toast.innerHTML =
            '<div style="display:flex;align-items:flex-start;gap:10px;">' +
                '<img src="' + logoUrl + '" style="width:38px;height:38px;object-fit:contain;flex-shrink:0;border-radius:6px;background:#f8f8f8;padding:2px;" alt="" onerror="this.style.display=\'none\'">' +
                '<div style="flex:1;min-width:0;">' +
                    '<div style="display:flex;align-items:flex-start;justify-content:space-between;gap:6px;margin-bottom:3px;">' +
                        '<div style="font-weight:700;font-size:.87rem;color:#1e293b;white-space:nowrap;overflow:hidden;text-overflow:ellipsis;">' +
                            (title || 'إشعار جديد') +
                        '</div>' +
                        '<button style="flex-shrink:0;background:none;border:none;cursor:pointer;color:#94a3b8;font-size:.85rem;padding:0;line-height:1;margin-top:1px;" class="toast-close-btn"><i class="fa-solid fa-xmark"></i></button>' +
                    '</div>' +
                    (body ? '<div style="font-size:.78rem;color:#64748b;line-height:1.5;display:-webkit-box;-webkit-line-clamp:2;-webkit-box-orient:vertical;overflow:hidden;">' + body + '</div>' : '') +
                    '<div style="font-size:.72rem;color:#b68a35;font-weight:600;margin-top:4px;">الاتحاد الإماراتي للمتقاعدين</div>' +
                '</div>' +
            '</div>' +
            '<div class="toast-progress" style="position:absolute;bottom:0;right:0;left:0;height:3px;background:#b68a35;transform-origin:right;animation:toastProgress 5s linear forwards;"></div>';

        toastContainer.prepend(toast);

        toast.querySelector('.toast-close-btn').addEventListener('click', function (e) {
            e.stopPropagation();
            dismissToast(toast);
        });

        var timer = setTimeout(function () { dismissToast(toast); }, 5000);
        toast.dataset.timer = timer;
    }

    function dismissToast(toast) {
        clearTimeout(parseInt(toast.dataset.timer));
        toast.style.animation = 'toastOut .25s ease forwards';
        setTimeout(function () { toast.remove(); }, 260);
    }

    if (!document.getElementById('toast-keyframes')) {
        var style = document.createElement('style');
        style.id = 'toast-keyframes';
        style.textContent =
            '@keyframes toastIn{from{opacity:0;transform:translateX(60px)}to{opacity:1;transform:translateX(0)}}' +
            '@keyframes toastOut{from{opacity:1;transform:translateX(0)}to{opacity:0;transform:translateX(60px)}}' +
            '@keyframes toastProgress{from{transform:scaleX(1)}to{transform:scaleX(0)}}';
        document.head.appendChild(style);
    }

    // ── Badge helpers ─────────────────────────────────────────────────────────
    function currentBadge() {
        const badge = document.querySelector('.member-notifications-badge');
        return badge ? parseInt(badge.textContent) || 0 : 0;
    }

    function updateBadge(count) {
        var badge = document.querySelector('.member-notifications-badge');
        var btn   = document.getElementById('toggleMemberNotifications');
        if (count > 0) {
            var txt = count > 99 ? '99+' : count;
            if (badge) { badge.textContent = txt; }
            else if (btn) {
                var b = document.createElement('span');
                b.className = 'member-notifications-badge';
                b.textContent = txt;
                btn.appendChild(b);
            }
        } else if (badge) {
            badge.remove();
        }
    }

    // ── Add notification item to the panel dynamically ───────────────────────
    function addNotifToPanel(id, title, body) {
        const notifBody = document.querySelector('.notif-screen__body');
        if (!notifBody) return;

        notifBody.querySelector('.notif-screen__empty')?.remove();

        const sectionTitle = notifBody.querySelector('.notif-screen__section-title:last-of-type');

        const item = document.createElement('div');
        item.className = 'notif-screen__item notif-screen__item--new';
        item.setAttribute('data-id', id);
        item.setAttribute('data-title', title || '');
        item.setAttribute('data-body', body || '');
        item.style.cssText = 'cursor:pointer;animation:toastIn .3s ease;';
        item.innerHTML =
            '<div class="notif-screen__item-icon notif-screen__item-icon--bell">' +
                '<i class="fa-solid fa-circle-info"></i>' +
            '</div>' +
            '<div class="notif-screen__item-content">' +
                '<div class="notif-screen__item-title">' + (title || '') + '</div>' +
                '<div class="notif-screen__item-body">' + (body || '').substring(0, 80) + '</div>' +
                '<div class="notif-screen__item-time">الآن</div>' +
            '</div>' +
            '<button type="button" class="notif-screen__dismiss" title="تجاهل">' +
                '<i class="fa-solid fa-xmark"></i>' +
            '</button>';

        if (sectionTitle) {
            sectionTitle.after(item);
        } else {
            notifBody.prepend(item);
        }

        bindNotifItem(item);
        bindDismissBtn(item.querySelector('.notif-screen__dismiss'));
    }

    // ── Polling (fallback) ────────────────────────────────────────────────────
    var shownKey = 'shown_notif_ids';

    function getShown() {
        try { return JSON.parse(sessionStorage.getItem(shownKey) || '[]'); } catch(e) { return []; }
    }

    function markShown(id) {
        var arr = getShown();
        if (arr.indexOf(id) === -1) {
            arr.push(id);
            if (arr.length > 100) arr = arr.slice(-100);
            sessionStorage.setItem(shownKey, JSON.stringify(arr));
        }
    }

    function pollNotifications() {
        fetch('/members/notifications', {
            headers: { 'Accept': 'application/json', 'X-Requested-With': 'XMLHttpRequest' },
            credentials: 'same-origin',
        })
        .then(function (r) { return r.ok ? r.json() : null; })
        .then(function (data) {
            if (!data || !Array.isArray(data.notifications)) return;

            var shown = getShown();
            var toShow = data.notifications.filter(function (n) {
                return !n.read_at && shown.indexOf(n.id) === -1;
            });

            toShow.slice(0, 3).forEach(function (n) {
                showToast(n.title, n.body, n.id);
                markShown(n.id);
            });

            updateBadge(data.total_badge);
        })
        .catch(function () {});
    }

    // ── Pusher real-time ──────────────────────────────────────────────────────
    var pusherKey     = window.__PUSHER_KEY__     || '';
    var pusherCluster = window.__PUSHER_CLUSTER__ || 'mt1';
    var authUserId    = window.__AUTH_USER_ID__   || 0;
    var usePusher     = false;

    if (pusherKey && authUserId && typeof Pusher !== 'undefined') {
        try {
            var pusher = new Pusher(pusherKey, {
                cluster:       pusherCluster,
                forceTLS:      true,
                authEndpoint:  '/broadcasting/auth',
                auth: {
                    headers: {
                        'X-CSRF-TOKEN': csrf,
                        'X-Requested-With': 'XMLHttpRequest',
                    },
                },
            });

            var channel = pusher.subscribe('private-member-notifications.' + authUserId);

            channel.bind('new-notification', function (data) {
                var id    = data.notificationId || data.notification_id;
                var title = data.title || '';
                var body  = data.body  || '';

                if (id) markShown(id);

                showToast(title, body, id);
                addNotifToPanel(id, title, body);
                updateBadge(currentBadge() + 1);
            });

            channel.bind('pusher:subscription_succeeded', function () {
                usePusher = true;
            });

            channel.bind('pusher:subscription_error', function () {
                usePusher = false;
            });

            pusher.connection.bind('connected', function () {
                usePusher = true;
            });

            pusher.connection.bind('disconnected', function () {
                usePusher = false;
            });

        } catch (err) {
            usePusher = false;
        }
    }

    // Init: mark all current notifications as seen (no toast on page load)
    fetch('/members/notifications', {
        headers: { 'Accept': 'application/json', 'X-Requested-With': 'XMLHttpRequest' },
        credentials: 'same-origin',
    })
    .then(function (r) { return r.ok ? r.json() : null; })
    .then(function (data) {
        if (!data || !Array.isArray(data.notifications)) return;
        data.notifications.forEach(function (n) { markShown(n.id); });
        updateBadge(data.total_badge);
    })
    .catch(function () {})
    .finally(function () {
        // Polling: every 5s when Pusher disconnected, every 30s when connected
        setInterval(function () {
            if (!usePusher) pollNotifications();
        }, 5000);

        setInterval(pollNotifications, 30000);
    });

})();
