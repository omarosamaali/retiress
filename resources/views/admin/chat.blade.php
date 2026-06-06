@extends('layouts.admin')

@section('title', 'مراسلة الأعضاء')
@section('page-title', 'مراسلة الأعضاء')

@section('content')
<style>
    .ac-wrap {
        display: flex;
        height: calc(100vh - 120px);
        background: #fff;
        border-radius: 14px;
        box-shadow: 0 4px 24px rgba(0,0,0,.08);
        overflow: hidden;
    }

    /* ── Sidebar ── */
    .ac-sidebar {
        width: 300px;
        flex-shrink: 0;
        display: flex;
        flex-direction: column;
        background: #016330;
        border-radius: 14px 0 0 14px;
    }
    .ac-sidebar__head {
        padding: 18px 16px 12px;
        border-bottom: 1px solid rgba(255,255,255,.12);
    }
    .ac-sidebar__title {
        color: #fff;
        font-size: 1rem;
        font-weight: 700;
        margin-bottom: 10px;
        display: flex;
        align-items: center;
        gap: 6px;
    }
    .ac-search {
        position: relative;
    }
    .ac-search input {
        width: 100%;
        background: rgba(255,255,255,.15);
        border: 1px solid rgba(255,255,255,.25);
        border-radius: 8px;
        color: #fff;
        padding: 7px 34px 7px 10px;
        font-size: .88rem;
        outline: none;
        transition: background .2s;
    }
    .ac-search input::placeholder { color: rgba(255,255,255,.6); }
    .ac-search input:focus { background: rgba(255,255,255,.22); }
    .ac-search__icon {
        position: absolute;
        left: 9px;
        top: 50%;
        transform: translateY(-50%);
        color: rgba(255,255,255,.7);
        font-size: .8rem;
        pointer-events: none;
    }

    .ac-list {
        flex: 1;
        overflow-y: auto;
        padding: 6px 0;
    }
    .ac-list::-webkit-scrollbar { width: 4px; }
    .ac-list::-webkit-scrollbar-thumb { background: rgba(255,255,255,.25); border-radius: 4px; }

    .ac-user {
        display: flex;
        align-items: center;
        gap: 10px;
        padding: 10px 16px;
        cursor: pointer;
        border-bottom: 1px solid rgba(255,255,255,.06);
        transition: background .18s;
    }
    .ac-user:hover { background: rgba(255,255,255,.1); }
    .ac-user.active { background: rgba(255,255,255,.18); border-right: 3px solid #10b981; }
    .ac-user__avatar {
        width: 38px;
        height: 38px;
        border-radius: 50%;
        background: linear-gradient(135deg,#10b981,#059669);
        color: #fff;
        font-weight: 700;
        font-size: .85rem;
        display: flex;
        align-items: center;
        justify-content: center;
        flex-shrink: 0;
        text-transform: uppercase;
    }
    .ac-user__name {
        color: #fff;
        font-size: .88rem;
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
    }
    .ac-user--hidden { display: none; }

    /* ── Chat panel ── */
    .ac-chat {
        flex: 1;
        display: flex;
        flex-direction: column;
        background: #f8fafc;
    }
    .ac-chat__head {
        padding: 16px 22px;
        background: #fff;
        border-bottom: 1px solid #e5e7eb;
        font-weight: 600;
        color: #1e293b;
        font-size: .95rem;
        display: flex;
        align-items: center;
        gap: 8px;
        min-height: 60px;
    }
    .ac-chat__head-avatar {
        width: 34px;
        height: 34px;
        border-radius: 50%;
        background: linear-gradient(135deg,#10b981,#059669);
        color: #fff;
        font-weight: 700;
        font-size: .8rem;
        display: flex;
        align-items: center;
        justify-content: center;
        flex-shrink: 0;
        display: none;
    }
    .ac-messages {
        flex: 1;
        padding: 18px 22px;
        overflow-y: auto;
        display: flex;
        flex-direction: column;
        gap: 10px;
    }
    .ac-messages::-webkit-scrollbar { width: 5px; }
    .ac-messages::-webkit-scrollbar-thumb { background: #cbd5e1; border-radius: 4px; }

    .ac-msg {
        max-width: 68%;
        padding: 10px 14px;
        border-radius: 14px;
        font-size: .9rem;
        line-height: 1.45;
        word-break: break-word;
        animation: msgIn .2s ease;
    }
    @keyframes msgIn { from { opacity:0; transform:translateY(6px); } to { opacity:1; transform:none; } }
    .ac-msg.sent { background:#016330; color:#fff; border-bottom-right-radius:3px; align-self:flex-end; }
    .ac-msg.received { background:#fff; color:#334155; border-bottom-left-radius:3px; align-self:flex-start; box-shadow:0 1px 4px rgba(0,0,0,.08); }

    .ac-empty {
        flex: 1;
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        color: #94a3b8;
        gap: 8px;
        font-size: .9rem;
    }
    .ac-empty i { font-size: 2.2rem; }

    .ac-form {
        padding: 14px 18px;
        background: #fff;
        border-top: 1px solid #e5e7eb;
        display: flex;
        gap: 10px;
        align-items: center;
    }
    .ac-form input {
        flex: 1;
        border: 1.5px solid #e2e8f0;
        border-radius: 22px;
        padding: 9px 16px;
        font-size: .9rem;
        outline: none;
        background: #f8fafc;
        transition: border-color .2s;
        font-family: inherit;
    }
    .ac-form input:focus { border-color: #016330; background: #fff; }
    .ac-form button {
        background: #016330;
        color: #fff;
        border: none;
        border-radius: 22px;
        padding: 9px 18px;
        font-size: .88rem;
        font-family: inherit;
        cursor: pointer;
        display: flex;
        align-items: center;
        gap: 5px;
        transition: background .18s;
    }
    .ac-form button:hover { background: #014d25; }
</style>

<div class="ac-wrap">

    {{-- ── Sidebar ── --}}
    <div class="ac-sidebar">
        <div class="ac-sidebar__head">
            <div class="ac-sidebar__title">
                <i class="fa-solid fa-users"></i>
                @if(Auth::user()->role === 'مدير') الأعضاء المسجلون @else المديرون @endif
            </div>
            <div class="ac-search">
                <input type="text" id="ac-search-input" placeholder="ابحث باسم العضو...">
                <i class="fa-solid fa-magnifying-glass ac-search__icon"></i>
            </div>
        </div>

        <div class="ac-list" id="ac-list">
            @php
                $listItems = (Auth::user()->role === 'مدير' && isset($users)) ? $users : $contacts;
            @endphp
            @foreach($listItems as $item)
            @php
                $words = explode(' ', trim($item->name));
                $initials = mb_substr($words[0] ?? '?', 0, 1) . (isset($words[1]) ? mb_substr($words[1], 0, 1) : '');
            @endphp
            <div class="ac-user" data-user-id="{{ $item->id }}" data-name="{{ $item->name }}">
                <div class="ac-user__avatar">{{ $initials }}</div>
                <span class="ac-user__name">{{ $item->name }}</span>
            </div>
            @endforeach
        </div>
    </div>

    {{-- ── Chat ── --}}
    <div class="ac-chat">
        <div class="ac-chat__head" id="ac-chat-head">
            <div class="ac-chat__head-avatar" id="ac-head-avatar"></div>
            <span id="ac-chat-title">اختر عضواً للمحادثة</span>
        </div>

        <div class="ac-messages" id="ac-messages">
            <div class="ac-empty" id="ac-empty">
                <i class="fa-regular fa-comments"></i>
                <span>اختر عضواً من القائمة لبدء المحادثة</span>
            </div>
        </div>

        <form class="ac-form" id="ac-send-form">
            <input type="hidden" id="to_user_id">
            <input type="text" id="ac-msg-input" placeholder="اكتب رسالة..." autocomplete="off">
            <button type="submit">
                <i class="fa-solid fa-paper-plane"></i> إرسال
            </button>
        </form>
    </div>

</div>

<script>
const ME = {{ Auth::id() }};
let currentUserId = null;

// ── Search ──
document.getElementById('ac-search-input').addEventListener('input', function () {
    const q = this.value.trim().toLowerCase();
    document.querySelectorAll('.ac-user').forEach(el => {
        const name = el.dataset.name.toLowerCase();
        el.classList.toggle('ac-user--hidden', q && !name.includes(q));
    });
});

// ── Select user ──
document.querySelectorAll('.ac-user').forEach(el => {
    el.addEventListener('click', function () {
        document.querySelectorAll('.ac-user').forEach(u => u.classList.remove('active'));
        this.classList.add('active');

        currentUserId = this.dataset.userId;
        document.getElementById('to_user_id').value = currentUserId;

        const name    = this.dataset.name;
        const initials = [...name.trim().split(' ')].slice(0,2).map(w => w[0] || '').join('').toUpperCase();

        const headAvatar = document.getElementById('ac-head-avatar');
        headAvatar.textContent = initials;
        headAvatar.style.display = 'flex';
        document.getElementById('ac-chat-title').textContent = name;

        loadMessages(currentUserId);
    });
});

// ── Load messages ──
function loadMessages(userId) {
    fetch(`/messages/${userId}`)
        .then(r => r.json())
        .then(messages => {
            const box = document.getElementById('ac-messages');
            document.getElementById('ac-empty').style.display = 'none';
            box.innerHTML = '';

            messages.forEach(msg => {
                const p = document.createElement('p');
                p.className = 'ac-msg ' + (msg.from_user_id == ME ? 'sent' : 'received');
                p.textContent = msg.message;
                box.appendChild(p);
            });
            box.scrollTop = box.scrollHeight;
        });
}

// ── Send ──
document.getElementById('ac-send-form').addEventListener('submit', function (e) {
    e.preventDefault();
    const toId = document.getElementById('to_user_id').value;
    const input = document.getElementById('ac-msg-input');
    const text  = input.value.trim();
    if (!toId || !text) return;

    fetch('/send-message', {
        method: 'POST',
        headers: { 'Content-Type': 'application/json', 'X-CSRF-TOKEN': '{{ csrf_token() }}' },
        body: JSON.stringify({ to_user_id: toId, message: text })
    }).then(r => r.json()).then(() => {
        input.value = '';
        loadMessages(toId);
    });
});

// ── Realtime ──
window.Echo.private(`chat.{{ Auth::id() }}`)
    .listen('MessageSent', (e) => {
        if (currentUserId == e.message.from_user_id || currentUserId == e.message.to_user_id) {
            loadMessages(currentUserId);
        }
    });
</script>
@endsection
