@extends('layouts.admin')

@section('title', $pageTitle)
@section('page-title', $pageTitle)

@section('content')
    <p class="text-muted mb-3">{{ __('app.chat_admin_hint') }}</p>

    <x-chat-interface
        :contacts="$contacts"
        :contacts-title="__('app.registered_members')"
        :empty-hint="__('app.select_member_to_chat')"
        :messages-base-url="url('/admin/chat/messages')"
        :send-url="route('admin.chat.send')"
    />
@endsection
