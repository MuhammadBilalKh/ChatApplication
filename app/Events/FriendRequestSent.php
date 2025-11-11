<?php
namespace App\Events;

use App\Models\User;
use Illuminate\Broadcasting\Channel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

class FriendRequestSent implements ShouldBroadcast
{
    use InteractsWithSockets, SerializesModels;

    public $sender;
    public $receiverId;

    public function __construct(User $sender, $receiverId)
    {
        $this->sender = $sender;
        $this->receiverId = $receiverId;
    }

    public function broadcastOn(): Channel
    {
        return new PrivateChannel('friend-requests.' . $this->receiverId);
    }
}
