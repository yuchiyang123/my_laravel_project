<?php
namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

class msg_outside implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $message_id;
    public $message;
    public $fromUserId;
    public $toUserId;

    public function __construct($fromUserId, $toUserId, $message,$message_id)
    {
        $this->message_id = $message_id;
        $this->fromUserId = $fromUserId;
        $this->toUserId = $toUserId;
        $this->message = $message;
    }

    public function broadcastOn()
    {
        
        return new Channel('chat' . $this->fromUserId. $this->toUserId);
    }
    
}
