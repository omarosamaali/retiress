<?php

use Illuminate\Support\Facades\Broadcast;

Broadcast::channel('chat.{userId}', function ($user, $userId) {
    return (int) $user->id === (int) $userId || $user->isStaff();
});

Broadcast::channel('member-notifications.{userId}', function ($user, $userId) {
    return $user->isMemberRole() && (int) $user->id === (int) $userId;
});