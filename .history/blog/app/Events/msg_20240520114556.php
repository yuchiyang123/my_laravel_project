<?php
namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

class msg implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $message;
    public $fromUserId;
    public $toUserId;
    public $user_name;

    public function __construct($fromUserId, $toUserId, $message,$user_name)
    {
        $this->fromUserId = $fromUserId;
        $this->toUserId = $toUserId;
        $this->message = $message;
        $this->user_name = $user_name;
    }

    public function broadcastOn()
    {
        
        return new Channel('chata' . $this->fromUserId. $this->toUserId);
    }
    
}
