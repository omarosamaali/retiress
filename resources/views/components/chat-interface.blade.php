@props([
    'contacts',
    'contactsTitle' => __('app.chat_contacts'),
    'emptyHint' => __('app.select_contact_to_chat'),
    'messagesBaseUrl' => url('/messages'),
    'sendUrl' => null,
])

@php
    $sendUrl = $sendUrl ?? route('chat.send');
@endphp

<style>
.site-chat { height: calc(100vh - 130px); display: flex; }
.site-chat__layout { display: flex; flex: 1; background: #fff; border-radius: 14px; box-shadow: 0 4px 24px rgba(0,0,0,.08); overflow: hidden; }

/* ── Sidebar ── */
.site-chat__sidebar {
    width: 300px;
    flex-shrink: 0;
    display: flex;
    flex-direction: column;
    background: #016330;
    border-radius: 14px 0 0 14px;
}
.site-chat__sidebar-head {
    padding: 16px 14px 10px;
    border-bottom: 1px solid rgba(255,255,255,.12);
}
.site-chat__sidebar-title {
    color: #fff;
    font-size: .95rem;
    font-weight: 700;
    margin: 0 0 10px;
    display: flex;
    align-items: center;
    gap: 6px;
}
.site-chat__search {
    position: relative;
}
.site-chat__search input {
    width: 100%;
    background: rgba(255,255,255,.15);
    border: 1px solid rgba(255,255,255,.22);
    border-radius: 8px;
    color: #fff;
    padding: 7px 32px 7px 10px;
    font-size: .85rem;
    outline: none;
    font-family: inherit;
    box-sizing: border-box;
}
.site-chat__search input::placeholder { color: rgba(255,255,255,.55); }
.site-chat__search input:focus { background: rgba(255,255,255,.22); }
.site-chat__search-icon {
    position: absolute;
    left: 9px; top: 50%;
    transform: translateY(-50%);
    color: rgba(255,255,255,.6);
    font-size: .78rem;
    pointer-events: none;
}

.site-chat__contacts {
    list-style: none;
    margin: 0;
    padding: 4px 0;
    flex: 1;
    overflow-y: auto;
}
.site-chat__contacts::-webkit-scrollbar { width: 4px; }
.site-chat__contacts::-webkit-scrollbar-thumb { background: rgba(255,255,255,.2); border-radius: 4px; }

.site-chat__contact {
    width: 100%;
    display: flex;
    align-items: center;
    gap: 10px;
    padding: 10px 14px;
    background: none;
    border: none;
    border-bottom: 1px solid rgba(255,255,255,.06);
    cursor: pointer;
    text-align: right;
    transition: background .15s;
    font-family: inherit;
}
.site-chat__contact:hover { background: rgba(255,255,255,.1); }
.site-chat__contact.active { background: rgba(255,255,255,.18); border-right: 3px solid #10b981; }
.site-chat__contact--hidden { display: none !important; }

.site-chat__avatar {
    width: 38px; height: 38px;
    border-radius: 50%;
    background: linear-gradient(135deg,#10b981,#059669);
    color: #fff;
    font-weight: 700;
    font-size: .85rem;
    display: flex;
    align-items: center;
    justify-content: center;
    flex-shrink: 0;
    position: relative;
}
.site-chat__avatar .badge-dot {
    position: absolute;
    top: -2px; left: -2px;
    background: #ef4444;
    color: #fff;
    font-size: .65rem;
    font-weight: 700;
    border-radius: 50px;
    min-width: 18px;
    height: 18px;
    display: flex;
    align-items: center;
    justify-content: center;
    padding: 0 4px;
    border: 2px solid #016330;
}

.site-chat__contact-info {
    flex: 1;
    min-width: 0;
}
.site-chat__contact-name {
    color: #fff;
    font-size: .88rem;
    font-weight: 600;
    white-space: nowrap;
    overflow: hidden;
    text-overflow: ellipsis;
    display: block;
}
.site-chat__contact-preview {
    color: rgba(255,255,255,.6);
    font-size: .77rem;
    white-space: nowrap;
    overflow: hidden;
    text-overflow: ellipsis;
    display: block;
    margin-top: 2px;
}
.site-chat__contact-meta {
    display: flex;
    flex-direction: column;
    align-items: flex-end;
    gap: 4px;
    flex-shrink: 0;
}
.site-chat__contact-time {
    color: rgba(255,255,255,.5);
    font-size: .72rem;
}

.site-chat__empty-contacts {
    color: rgba(255,255,255,.6);
    text-align: center;
    padding: 20px;
    font-size: .85rem;
}

/* ── Main ── */
.site-chat__main {
    flex: 1;
    display: flex;
    flex-direction: column;
    background: #f8fafc;
}
.site-chat__header {
    padding: 14px 20px;
    background: #fff;
    border-bottom: 1px solid #e5e7eb;
    display: flex;
    align-items: center;
    gap: 10px;
    min-height: 60px;
}
.site-chat__header-avatar {
    width: 34px; height: 34px;
    border-radius: 50%;
    background: linear-gradient(135deg,#10b981,#059669);
    color: #fff;
    font-weight: 700;
    font-size: .8rem;
    display: none;
    align-items: center;
    justify-content: center;
    flex-shrink: 0;
}
#chatActiveTitle {
    font-size: .95rem;
    font-weight: 600;
    color: #1e293b;
    margin: 0;
}

.site-chat__messages {
    flex: 1;
    padding: 16px 20px;
    overflow-y: auto;
    display: flex;
    flex-direction: column;
    gap: 10px;
}
.site-chat__messages::-webkit-scrollbar { width: 5px; }
.site-chat__messages::-webkit-scrollbar-thumb { background: #cbd5e1; border-radius: 4px; }

.site-chat__placeholder {
    flex: 1;
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;
    color: #94a3b8;
    gap: 8px;
    font-size: .9rem;
    text-align: center;
    padding: 40px;
    margin: auto;
}

.site-chat__msg {
    max-width: 68%;
    padding: 10px 14px;
    border-radius: 14px;
    font-size: .9rem;
    line-height: 1.45;
    word-break: break-word;
    animation: msgIn .2s ease;
}
@keyframes msgIn { from { opacity:0; transform:translateY(6px); } to { opacity:1; transform:none; } }
.site-chat__msg.sent { background: #016330; color: #fff; border-bottom-right-radius: 3px; align-self: flex-end; }
.site-chat__msg.received { background: #fff; color: #334155; border-bottom-left-radius: 3px; align-self: flex-start; box-shadow: 0 1px 4px rgba(0,0,0,.08); }

.site-chat__composer {
    padding: 12px 16px;
    background: #fff;
    border-top: 1px solid #e5e7eb;
    display: flex;
    gap: 10px;
    align-items: center;
}
.site-chat__composer input[type="text"] {
    flex: 1;
    border: 1.5px solid #e2e8f0;
    border-radius: 22px;
    padding: 9px 16px;
    font-size: .9rem;
    outline: none;
    background: #f8fafc;
    font-family: inherit;
    transition: border-color .2s;
}
.site-chat__composer input[type="text"]:focus { border-color: #016330; background: #fff; }
.site-chat__composer button {
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
.site-chat__composer button:hover { background: #014d25; }
.site-chat__composer button:disabled { opacity: .5; cursor: default; }
</style>

<div class="site-chat" dir="rtl">
    <div class="site-chat__layout">

        {{-- ── Sidebar ── --}}
        <aside class="site-chat__sidebar">
            <div class="site-chat__sidebar-head">
                <h3 class="site-chat__sidebar-title">
                    <i class="fa-solid fa-users"></i> {{ $contactsTitle }}
                </h3>
                <div class="site-chat__search">
                    <input type="text" id="chatSearchInput" placeholder="ابحث باسم...">
                    <i class="fa-solid fa-magnifying-glass site-chat__search-icon"></i>
                </div>
            </div>

            <ul class="site-chat__contacts" id="chatContacts">
                @forelse ($contacts as $contact)
                @php
                    $initials = mb_substr($contact->name ?? '?', 0, 1);
                    $unread   = $contact->unread_count ?? 0;
                    $lastMsg  = $contact->last_message ?? null;
                    $lastAt   = $contact->last_message_at ?? null;
                    $timeStr  = $lastAt ? \Carbon\Carbon::parse($lastAt)->diffForHumans(null, true) : '';
                @endphp
                <li>
                    <button type="button"
                        class="site-chat__contact"
                        data-user-id="{{ $contact->id }}"
                        data-user-name="{{ $contact->name }}"
                        data-initials="{{ $initials }}">

                        <div class="site-chat__avatar">
                            {{ $initials }}
                            @if($unread > 0)
                                <span class="badge-dot">{{ $unread }}</span>
                            @endif
                        </div>

                        <div class="site-chat__contact-info">
                            <span class="site-chat__contact-name">{{ $contact->name }}</span>
                            @if($lastMsg)
                                <span class="site-chat__contact-preview">{{ Str::limit($lastMsg, 30) }}</span>
                            @endif
                        </div>

                        @if($timeStr)
                        <div class="site-chat__contact-meta">
                            <span class="site-chat__contact-time">{{ $timeStr }}</span>
                        </div>
                        @endif
                    </button>
                </li>
                @empty
                    <li class="site-chat__empty-contacts">{{ __('app.no_chat_contacts') }}</li>
                @endforelse
            </ul>
        </aside>

        {{-- ── Main ── --}}
        <section class="site-chat__main">
            <header class="site-chat__header">
                <div class="site-chat__header-avatar" id="chatHeaderAvatar"></div>
                <h3 id="chatActiveTitle">{{ $emptyHint }}</h3>
            </header>

            <div class="site-chat__messages" id="chatMessages">
                <p class="site-chat__placeholder">
                    <i class="fa-regular fa-comments" style="font-size:2.5rem;opacity:.35;"></i>
                    {{ $emptyHint }}
                </p>
            </div>

            <form class="site-chat__composer" id="chatSendForm">
                <input type="hidden" id="chatToUserId" name="to_user_id" value="">
                <input type="text" id="chatMessageInput" placeholder="{{ __('app.type_message') }}" maxlength="2000" disabled>
                <button type="submit" id="chatSendBtn" disabled>
                    <i class="fa-solid fa-paper-plane"></i> {{ __('app.send') }}
                </button>
            </form>
        </section>
    </div>
</div>

<script>
    window.siteChatConfig = {
        currentUserId: {{ Auth::id() }},
        messagesUrl: @json(rtrim($messagesBaseUrl, '/')),
        sendUrl: @json($sendUrl),
        csrf: @json(csrf_token()),
        emptyMessagesText: @json(__('app.no_messages_yet')),
        loadErrorText: @json(__('app.chat_load_error')),
    };
</script>
<script src="{{ asset('assets/js/site-chat.js') }}" defer></script>
