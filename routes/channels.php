<?php

use Illuminate\Support\Facades\Broadcast;

Broadcast::channel('chat.{userId}', function ($user, $userId) {
return (int) $user->id === (int) $userId || $user->is_admin;
});