<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}" dir="rtl">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ $pageTitle }}</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fortawesome/fontawesome-free@6.5.2/css/all.min.css">
    <link rel="stylesheet" href="{{ asset('assets/css/styleU.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/custom.css') }}">
    <style>
        .chat-wrap {
            max-width: 780px;
            margin: 120px auto 50px;
            padding: 0 16px;
        }
        .chat-header-bar {
            display: flex;
            align-items: center;
            gap: 14px;
            background: #016330;
            color: #fff;
            border-radius: 16px 16px 0 0;
            padding: 18px 24px;
        }
        .chat-header-bar__avatar {
            width: 46px; height: 46px;
            border-radius: 50%;
            background: rgba(255,255,255,.2);
            display: flex; align-items: center; justify-content: center;
            font-size: 20px;
            flex-shrink: 0;
        }
        .chat-header-bar__info { flex: 1; }
        .chat-header-bar__name { font-size: 1rem; font-weight: 700; }
        .chat-header-bar__sub { font-size: 11px; opacity: .8; margin-top: 2px; }
        .chat-header-bar__dot {
            width: 10px; height: 10px; border-radius: 50%;
            background: #86efac; border: 2px solid #fff;
        }

        .chat-body {
            background: #f8fafc;
            border: 1px solid #e2e8f0;
            border-top: none;
            min-height: 420px;
            max-height: 480px;
            overflow-y: auto;
            padding: 20px 24px;
            display: flex;
            flex-direction: column;
            gap: 12px;
        }
        .chat-body::-webkit-scrollbar { width: 5px; }
        .chat-body::-webkit-scrollbar-thumb { background: #cbd5e1; border-radius: 3px; }

        .chat-msg {
            display: flex;
            gap: 10px;
            max-width: 72%;
        }
        .chat-msg--sent { align-self: flex-start; flex-direction: row-reverse; }
        .chat-msg--recv { align-self: flex-end; }

        .chat-msg__avatar {
            width: 34px; height: 34px; border-radius: 50%;
            display: flex; align-items: center; justify-content: center;
            font-size: 13px; font-weight: 700; flex-shrink: 0;
        }
        .chat-msg--sent .chat-msg__avatar { background: #016330; color: #fff; }
        .chat-msg--recv .chat-msg__avatar { background: #e2e8f0; color: #475569; }

        .chat-msg__bubble {
            padding: 10px 14px;
            border-radius: 16px;
            font-size: 14px;
            line-height: 1.5;
            word-break: break-word;
        }
        .chat-msg--sent .chat-msg__bubble {
            background: #016330; color: #fff;
            border-bottom-right-radius: 4px;
        }
        .chat-msg--recv .chat-msg__bubble {
            background: #fff; color: #1e293b;
            border: 1px solid #e2e8f0;
            border-bottom-left-radius: 4px;
        }
        .chat-msg__meta {
            font-size: 10px; opacity: .6; margin-top: 4px; text-align: left;
        }
        .chat-msg--sent .chat-msg__meta { text-align: right; }

        .chat-empty {
            display: flex; flex-direction: column;
            align-items: center; justify-content: center;
            flex: 1; gap: 10px; color: #94a3b8;
            padding: 40px 0;
        }
        .chat-empty i { font-size: 2.5rem; }

        .chat-composer {
            background: #fff;
            border: 1px solid #e2e8f0;
            border-top: none;
            border-radius: 0 0 16px 16px;
            padding: 16px 20px;
            display: flex;
            gap: 10px;
            align-items: center;
        }
        .chat-composer__input {
            flex: 1;
            border: 1.5px solid #e2e8f0;
            border-radius: 24px;
            padding: 10px 18px;
            font-size: 14px;
            outline: none;
            font-family: inherit;
            transition: border-color .2s;
            background: #f8fafc;
        }
        .chat-composer__input:focus { border-color: #016330; background: #fff; }
        .chat-composer__btn {
            background: #016330; color: #fff;
            border: none; border-radius: 50%;
            width: 44px; height: 44px;
            display: flex; align-items: center; justify-content: center;
            font-size: 16px; cursor: pointer;
            transition: background .2s, transform .15s;
            flex-shrink: 0;
        }
        .chat-composer__btn:hover { background: #014d25; transform: scale(1.05); }
        .chat-composer__btn:disabled { background: #94a3b8; cursor: not-allowed; transform: none; }

        .chat-no-staff {
            text-align: center; padding: 60px 20px;
            background: #fff; border-radius: 16px;
            border: 1px solid #e2e8f0;
            color: #64748b;
        }
        .chat-no-staff i { font-size: 3rem; color: #cbd5e1; display: block; margin-bottom: 12px; }
    </style>
</head>
<body>
    <x-guest-header></x-guest-header>

    <div class="chat-wrap">

        @if ($autoContact)
        {{-- Header --}}
        <div class="chat-header-bar">
            <div class="chat-header-bar__avatar">
                <i class="fa-solid fa-headset"></i>
            </div>
            <div class="chat-header-bar__info">
                <div class="chat-header-bar__name">فريق الإدارة</div>
                <div class="chat-header-bar__sub">أرسل رسالتك وسيرد عليك أحد أعضاء الفريق</div>
            </div>
            <div class="chat-header-bar__dot"></div>
        </div>

        {{-- Messages --}}
        <div class="chat-body" id="chatMessages">
            <div class="chat-empty" id="chatEmpty">
                <i class="fa-regular fa-comment-dots"></i>
                <span>لا توجد رسائل بعد — ابدأ المحادثة أدناه</span>
            </div>
        </div>

        {{-- Composer --}}
        <form class="chat-composer" id="chatForm">
            <input type="text" class="chat-composer__input" id="msgInput"
                   placeholder="اكتب رسالتك هنا..." maxlength="2000" autocomplete="off">
            <button type="submit" class="chat-composer__btn" title="إرسال">
                <i class="fa-solid fa-paper-plane"></i>
            </button>
        </form>

        @else
        <div class="chat-no-staff">
            <i class="fa-solid fa-headset"></i>
            <p>خدمة المراسلة غير متاحة حالياً. يرجى التواصل عبر الهاتف أو البريد الإلكتروني.</p>
        </div>
        @endif

    </div>

    <x-footer-section></x-footer-section>
    <script src="{{ asset('assets/js/jquery.js') }}"></script>
    <script src="{{ asset('assets/js/modernizr.min.js') }}"></script>
    <script src="{{ asset('assets/js/scriptU.js') }}"></script>

    @if ($autoContact)
    <script>
        const CURRENT_USER_ID = {{ Auth::id() }};
        const CONTACT_ID      = {{ $autoContact->id }};
        const CSRF            = '{{ csrf_token() }}';

        const msgsEl   = document.getElementById('chatMessages');
        const emptyEl  = document.getElementById('chatEmpty');
        const formEl   = document.getElementById('chatForm');
        const inputEl  = document.getElementById('msgInput');

        function renderMsg(msg) {
            const isSent   = msg.from_user_id == CURRENT_USER_ID;
            const initials = isSent ? 'أنت' : (msg.sender?.name?.charAt(0) ?? 'إ');
            const time     = msg.created_at
                ? new Date(msg.created_at).toLocaleTimeString('ar-AE', { hour: '2-digit', minute: '2-digit' })
                : '';

            const div = document.createElement('div');
            div.className = `chat-msg ${isSent ? 'chat-msg--sent' : 'chat-msg--recv'}`;
            div.innerHTML = `
                <div class="chat-msg__avatar">${initials}</div>
                <div>
                    <div class="chat-msg__bubble">${escHtml(msg.message)}</div>
                    <div class="chat-msg__meta">${time}</div>
                </div>`;
            return div;
        }

        function escHtml(str) {
            return String(str).replace(/&/g,'&amp;').replace(/</g,'&lt;').replace(/>/g,'&gt;');
        }

        function scrollBottom() {
            msgsEl.scrollTop = msgsEl.scrollHeight;
        }

        function loadMessages() {
            fetch(`/messages/${CONTACT_ID}`)
                .then(r => r.json())
                .then(msgs => {
                    // remove all message nodes but keep emptyEl
                    [...msgsEl.querySelectorAll('.chat-msg')].forEach(el => el.remove());
                    if (msgs.length) {
                        emptyEl.style.display = 'none';
                        msgs.forEach(m => msgsEl.appendChild(renderMsg(m)));
                    } else {
                        emptyEl.style.display = 'flex';
                    }
                    scrollBottom();
                });
        }

        formEl.addEventListener('submit', function(e) {
            e.preventDefault();
            const text = inputEl.value.trim();
            if (!text) return;

            const btn = formEl.querySelector('button');
            btn.disabled = true;

            fetch('/send-message', {
                method: 'POST',
                headers: { 'Content-Type': 'application/json', 'X-CSRF-TOKEN': CSRF },
                body: JSON.stringify({ to_user_id: CONTACT_ID, message: text })
            })
            .then(r => r.json())
            .then(data => {
                inputEl.value = '';
                if (data.message) {
                    emptyEl.style.display = 'none';
                    msgsEl.appendChild(renderMsg(data.message));
                    scrollBottom();
                }
            })
            .finally(() => { btn.disabled = false; inputEl.focus(); });
        });

        // Real-time
        if (window.Echo) {
            window.Echo.private(`chat.${CURRENT_USER_ID}`)
                .listen('MessageSent', (e) => {
                    if (e.message.from_user_id == CONTACT_ID) {
                        emptyEl.style.display = 'none';
                        msgsEl.appendChild(renderMsg(e.message));
                        scrollBottom();
                    }
                });
        }

        loadMessages();
        setInterval(loadMessages, 15000);
    </script>
    @endif
</body>
</html>
