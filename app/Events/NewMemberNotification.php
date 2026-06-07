<?php

namespace App\Events;

use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcastNow;
use Illuminate\Foundation\Events\Dispatchable;

class NewMemberNotification implements ShouldBroadcastNow
{
    use Dispatchable, InteractsWithSockets;

    public function __construct(
        public readonly int $userId,
        public readonly int $notificationId,
        public readonly string $title,
        public readonly string $body,
    ) {}

    public function broadcastOn(): array
    {
        return [new PrivateChannel('member-notifications.' . $this->userId)];
    }

    public function broadcastAs(): string
    {
        return 'new-notification';
    }
}
