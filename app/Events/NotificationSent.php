<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

class NotificationSent implements ShouldBroadcast
{
    use InteractsWithSockets, SerializesModels;

    public $receiverId;
    public $message;

    public function __construct($receiverId, $message)
    {
        $this->receiverId = $receiverId;
        $this->message = $message;
    }

    public function broadcastOn(): Channel
    {
        return new PrivateChannel('notifications.' . $this->receiverId);
    }
}
