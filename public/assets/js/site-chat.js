(function () {
    const root = document.querySelector('.site-chat');
    if (!root) return;

    const config = window.siteChatConfig || {};
    const currentUserId = config.currentUserId;
    const messagesUrl = config.messagesUrl;
    const sendUrl = config.sendUrl;
    const csrf = config.csrf || '';

    let activeUserId = null;

    const contacts = root.querySelectorAll('.site-chat__contact');
    const messagesEl = document.getElementById('chatMessages');
    const titleEl = document.getElementById('chatActiveTitle');
    const toInput = document.getElementById('chatToUserId');
    const messageInput = document.getElementById('chatMessageInput');
    const sendBtn = document.getElementById('chatSendBtn');
    const form = document.getElementById('chatSendForm');

    function selectContact(btn) {
        contacts.forEach(b => b.classList.remove('is-active'));
        btn.classList.add('is-active');
        activeUserId = btn.getAttribute('data-user-id');
        toInput.value = activeUserId;
        titleEl.textContent = btn.getAttribute('data-user-name');
        messageInput.disabled = false;
        sendBtn.disabled = false;
        loadMessages(activeUserId);
    }

    contacts.forEach(btn => {
        btn.addEventListener('click', () => selectContact(btn));
    });

    if (contacts.length === 1) {
        selectContact(contacts[0]);
    }

    function renderMessages(messages) {
        messagesEl.innerHTML = '';
        if (!messages.length) {
            const p = document.createElement('p');
            p.className = 'site-chat__placeholder';
            p.textContent = config.emptyMessagesText || '';
            messagesEl.appendChild(p);
            return;
        }
        messages.forEach(msg => {
            const bubble = document.createElement('div');
            const isMine = parseInt(msg.from_user_id, 10) === currentUserId;
            bubble.className = 'site-chat__bubble ' + (isMine ? 'site-chat__bubble--sent' : 'site-chat__bubble--received');
            bubble.textContent = msg.message;
            messagesEl.appendChild(bubble);
        });
        messagesEl.scrollTop = messagesEl.scrollHeight;
    }

    function loadMessages(userId) {
        fetch(messagesUrl + '/' + userId, {
            headers: { 'Accept': 'application/json', 'X-Requested-With': 'XMLHttpRequest' },
        })
            .then(r => {
                if (!r.ok) throw new Error('load failed');
                return r.json();
            })
            .then(renderMessages)
            .catch(() => {
                messagesEl.innerHTML = '<p class="text-danger">' + (config.loadErrorText || 'Error') + '</p>';
            });
    }

    form?.addEventListener('submit', function (e) {
        e.preventDefault();
        if (!activeUserId || !messageInput.value.trim()) return;

        fetch(sendUrl, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'Accept': 'application/json',
                'X-CSRF-TOKEN': csrf,
                'X-Requested-With': 'XMLHttpRequest',
            },
            body: JSON.stringify({
                to_user_id: activeUserId,
                message: messageInput.value.trim(),
            }),
        })
            .then(r => r.json())
            .then(() => {
                messageInput.value = '';
                loadMessages(activeUserId);
            });
    });

    if (typeof window.Echo !== 'undefined' && currentUserId) {
        window.Echo.private('chat.' + currentUserId)
            .listen('MessageSent', (e) => {
                if (!activeUserId || !e.message) return;
                if (parseInt(e.message.from_user_id, 10) === parseInt(activeUserId, 10)
                    || parseInt(e.message.to_user_id, 10) === parseInt(activeUserId, 10)) {
                    loadMessages(activeUserId);
                }
            });
    }
})();
