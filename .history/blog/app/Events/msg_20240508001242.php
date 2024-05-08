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

    public function __construct($fromUserId, $toUserId, $message)
    {
        $this->fromUserId = $fromUserId;
        $this->toUserId = $toUserId;
        $this->message = $message;
    }

    public function broadcastOn()
    {
        
        return new Channel('chata' . $this->fromUserId. $this->toUserId);
    }
    
}
