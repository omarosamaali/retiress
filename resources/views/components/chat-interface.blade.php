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

<div class="site-chat" dir="rtl">
    <div class="site-chat__layout">
        <aside class="site-chat__sidebar">
            <h3 class="site-chat__sidebar-title">{{ $contactsTitle }}</h3>
            <ul class="site-chat__contacts" id="chatContacts">
                @forelse ($contacts as $contact)
                    <li>
                        <button type="button" class="site-chat__contact" data-user-id="{{ $contact->id }}" data-user-name="{{ $contact->name }}">
                            <span class="site-chat__avatar">{{ mb_substr($contact->name, 0, 1) }}</span>
                            <span class="site-chat__contact-name">{{ $contact->name }}</span>
                        </button>
                    </li>
                @empty
                    <li class="site-chat__empty">{{ __('app.no_chat_contacts') }}</li>
                @endforelse
            </ul>
        </aside>

        <section class="site-chat__main">
            <header class="site-chat__header">
                <h3 id="chatActiveTitle">{{ $emptyHint }}</h3>
            </header>
            <div class="site-chat__messages" id="chatMessages">
                <p class="site-chat__placeholder">{{ $emptyHint }}</p>
            </div>
            <form class="site-chat__composer" id="chatSendForm">
                <input type="hidden" id="chatToUserId" name="to_user_id" value="">
                <input type="text" id="chatMessageInput" class="form-control" placeholder="{{ __('app.type_message') }}" maxlength="2000" disabled>
                <button type="submit" class="btn btn-primary" id="chatSendBtn" disabled>{{ __('app.send') }}</button>
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
