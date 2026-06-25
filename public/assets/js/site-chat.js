(function () {
    const root = document.querySelector('.site-chat');
    if (!root) return;

    const config        = window.siteChatConfig || {};
    const currentUserId = config.currentUserId;
    const messagesUrl   = config.messagesUrl;
    const sendUrl       = config.sendUrl;
    const csrf          = config.csrf || '';

    let activeUserId = null;

    const contactBtns = root.querySelectorAll('.site-chat__contact');
    const messagesEl  = document.getElementById('chatMessages');
    const titleEl     = document.getElementById('chatActiveTitle');
    const headerAvatar= document.getElementById('chatHeaderAvatar');
    const toInput     = document.getElementById('chatToUserId');
    const messageInput= document.getElementById('chatMessageInput');
    const sendBtn     = document.getElementById('chatSendBtn');
    const form        = document.getElementById('chatSendForm');
    const searchInput = document.getElementById('chatSearchInput');

    // ── Search ──
    searchInput?.addEventListener('input', function () {
        const q = this.value.trim().toLowerCase();
        contactBtns.forEach(btn => {
            const name = (btn.getAttribute('data-user-name') || '').toLowerCase();
            btn.closest('li').classList.toggle('site-chat__contact--hidden', q !== '' && !name.includes(q));
        });
    });

    // ── Select contact ──
    function selectContact(btn) {
        contactBtns.forEach(b => b.classList.remove('active'));
        btn.classList.add('active');

        activeUserId   = btn.getAttribute('data-user-id');
        toInput.value  = activeUserId;
        const name     = btn.getAttribute('data-user-name') || '';
        const initials = btn.getAttribute('data-initials') || name.charAt(0).toUpperCase();

        titleEl.textContent      = name;
        headerAvatar.textContent = initials;
        headerAvatar.style.display = 'flex';

        messageInput.disabled = false;
        sendBtn.disabled      = false;

        // مسح الـ unread badge عند فتح المحادثة
        const badge = btn.querySelector('.badge-dot');
        if (badge) badge.remove();

        loadMessages(activeUserId);
    }

    contactBtns.forEach(btn => btn.addEventListener('click', () => selectContact(btn)));

    // ── Render messages ──
    function renderMessages(messages) {
        messagesEl.innerHTML = '';
        if (!messages.length) {
            messagesEl.innerHTML = '<p class="site-chat__placeholder" style="margin:auto;text-align:center;color:#94a3b8;">' + (config.emptyMessagesText || 'لا توجد رسائل بعد') + '</p>';
            return;
        }
        messages.forEach(msg => {
            const div = document.createElement('div');
            const isMine = parseInt(msg.from_user_id, 10) === currentUserId;
            div.className = 'site-chat__msg ' + (isMine ? 'sent' : 'received');
            div.textContent = msg.message;
            messagesEl.appendChild(div);
        });
        messagesEl.scrollTop = messagesEl.scrollHeight;
    }

    // ── Load messages ──
    function loadMessages(userId) {
        fetch(messagesUrl + '/' + userId, {
            headers: { 'Accept': 'application/json', 'X-Requested-With': 'XMLHttpRequest' },
        })
            .then(r => { if (!r.ok) throw new Error(); return r.json(); })
            .then(renderMessages)
            .catch(() => {
                messagesEl.innerHTML = '<p class="text-danger" style="padding:20px;">' + (config.loadErrorText || 'حدث خطأ في التحميل') + '</p>';
            });
    }

    // ── Send message ──
    form?.addEventListener('submit', function (e) {
        e.preventDefault();
        if (!activeUserId || !messageInput.value.trim()) return;
        const text = messageInput.value.trim();
        messageInput.value = '';

        fetch(sendUrl, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'Accept': 'application/json',
                'X-CSRF-TOKEN': csrf,
                'X-Requested-With': 'XMLHttpRequest',
            },
            body: JSON.stringify({ to_user_id: activeUserId, message: text }),
        })
            .then(r => r.json())
            .then(() => loadMessages(activeUserId));
    });

    // ── Real-time ──
    if (typeof window.Echo !== 'undefined' && currentUserId) {
        window.Echo.private('chat.' + currentUserId)
            .listen('MessageSent', (e) => {
                if (!e.message) return;
                const fromId = parseInt(e.message.from_user_id, 10);
                const toId   = parseInt(e.message.to_user_id, 10);

                if (activeUserId && (fromId === parseInt(activeUserId, 10) || toId === parseInt(activeUserId, 10))) {
                    loadMessages(activeUserId);
                } else {
                    // إظهار badge للمُرسِل في القائمة
                    const senderBtn = root.querySelector('.site-chat__contact[data-user-id="' + fromId + '"]');
                    if (senderBtn) {
                        let badge = senderBtn.querySelector('.badge-dot');
                        if (!badge) {
                            badge = document.createElement('span');
                            badge.className = 'badge-dot';
                            badge.textContent = '1';
                            senderBtn.querySelector('.site-chat__avatar')?.appendChild(badge);
                        } else {
                            badge.textContent = (parseInt(badge.textContent, 10) || 0) + 1;
                        }
                    }
                }
            });
    }
})();
